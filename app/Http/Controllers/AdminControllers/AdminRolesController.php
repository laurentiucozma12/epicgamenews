<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Role;
use App\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class AdminRolesController extends Controller
{
    private $rules = ['name' => 'required|unique:roles,name'];

    public function index()
    { 
        // Create permissions if new Controllers were added
        $this->permissions();

        $roles = Role::with('createdByUser')->orderBy('id', 'DESC')->paginate(100);

        return view('admin_dashboard.roles.index', [
            'roles' => $roles,
        ]);
    }
    
    public function create()
    {
        // Create permissions if new Controllers were added
        $this->permissions();
        
        return view('admin_dashboard.roles.create', [
            'permissions' => Permission::all(),
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $permissions = $request->input('permissions');

        $role = Role::create($validated);
        $role->permissions()->sync( $permissions );

        return redirect()->route('admin.roles.create')->with('success', 'Role has been created');
    }

    public function edit(Role $role)
    {
        // Create permissions if new Controllers were added
        $this->permissions();

        return view('admin_dashboard.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Request $request, Role $role)
    {        
        if ($role->name === 'admin' || $role->name === 'user') {
            return redirect()->back()->with('danger', 'You cannot update the ' . $role->name . ' role');
        }

        $this->rules['name'] = ['required', Rule::unique('roles')->ignore($role)];
        $validated = $request->validate($this->rules);
        $permissions = $request->input('permissions');

        $role->update($validated);
        $role->permissions()->sync( $permissions );

        return redirect()->route('admin.roles.edit', $role)->with('success', 'Role has been updated');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'admin' || $role->name === 'user') {
            return redirect()->back()->with('danger', 'You cannot delete the ' . $role->name . ' role');
        }

        $role->delete();
        return redirect()->route('admin.roles.index', $role)->with('success', 'Role has been deleted');
    }

    private function permissions()
    {
        $blog_routes = Route::getRoutes();
        $permissions_ids = [];
        $permissions_names = [];

        foreach ($blog_routes as $route) {
            if (strpos($route->getName(), 'admin') !== false) {
                $permissionName = $route->getName();

                // Check if the permission already exists
                $existingPermission = Permission::where('name', $permissionName)->first();

                if (!$existingPermission) {
                    // Permission doesn't exist, create it
                    $permission = Permission::create(['name' => $permissionName]);
                    $permissions_ids[] = $permission->id;
                    $permissions_names[] = $permission->name;
                } else {
                    // Permission already exists, add it to the list
                    $permissions_ids[] = $existingPermission->id;
                    $permissions_names[] = $existingPermission->name;
                }
            }
        }
        
        // Update the "admin" role with the new permissions
        $adminRole = Role::where('name', 'admin')->first();
        
        if ($adminRole) {
            // Sync the permissions without detaching existing ones
            $adminRole->permissions()->syncWithoutDetaching($permissions_ids);
        }
        
        // 1. Get all admin routes
        $adminPermissions = Permission::all()->filter(function ($permission) {
            return strpos($permission->name, 'admin') !== false;
        })->toArray();
        
        // Extract strings from permission names
        $permissionsNames = array_map(function ($permission) {
            return $permission['name'];
        }, $adminPermissions);
        
        // Remove duplicates from the $permissionsNames array
        $uniquePermissionsNames = array_unique($permissionsNames);     

        // 2.Get all unique admin permissions from DB
        $permissions_names = array_unique($permissions_names);

        // Remove extra permissions from $uniquePermissionsNames
        $finalPermission = array_diff($uniquePermissionsNames, $permissions_names);

        // If count($adminPermissions) !== count($permissions_names)
        // it means, the code was updated, and some routes were added or removed
        // so we have to automatically update the database, removing the extra permissions
        if (count($adminPermissions) !== count($permissions_names)) {
            $permission = Permission::where('name', $finalPermission)->first();
        
            if ($permission) {
                $permission->delete();
            }        
        }        


    }


}
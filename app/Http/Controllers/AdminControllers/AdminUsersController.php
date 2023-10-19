<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Models\Role;
use App\Models\User;

class AdminUsersController extends Controller
{
    private $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:3|max:20',
        'image' => 'nullable|image|dimensions:max_width=1920,max_height=1080',
    ];

    public function index()
    {
        return view('admin_dashboard.users.index', [
            'users' => User::with('roles')->orderBy('id', 'DESC')->paginate(100)
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.users.create', [
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $selectedRole = $request->input('roles', []);
        $validated = $request->validate($this->rules);
        $validated['password'] = Hash::make($request->input('password'));
        $user = User::create($validated);

        if($request->has('image'))
        {
            $image = $request->file('image');
            
            $filename = $image->getClientOriginalName();
            $file_extension = $image->getClientOriginalExtension();
            $path = $image->store('users', 'public');

            $user->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }

        $user->roles()->attach($selectedRole);

        return redirect()->route('admin.users.create')->with('success', 'User has been created.');
    }

    public function edit(User $user)
    {        
        $roles = Role::pluck('roles.name', 'roles.id');
        $selectedRoleIds = $user->roles->pluck('id')->toArray();

        return view('admin_dashboard.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'selectedRoleIds' => $selectedRoleIds,
        ]);
    }

    public function showUsers(User $user)
    {
        $posts = $user->posts()->latest()->paginate(100);        

        return view('admin_dashboard.users.show_users',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function showPosts(User $user)
    {
        $posts = $user->posts()->latest()->paginate(100);
        return view('admin_dashboard.users.show_posts',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function showVideoGames(User $user)
    {
        $video_games = $user->videoGames()->latest()->paginate(100);
        return view('admin_dashboard.users.show_video_games',[
            'user' => $user,
            'video_games' => $video_games,
        ]);
    }

    public function showCategories(User $user)
    {
        $categories = $user->categories()->latest()->paginate(100);
        return view('admin_dashboard.users.show_categories',[
            'user' => $user,
            'categories' => $categories,
        ]);
    }
    
    public function update(Request $request, User $user)
    {
        // Transform the input role_ids into an array
        $roleIds = $request->input('roles', []);

        // Check if the user is trying to change their own role
        if ($user->id === auth()->id() && !in_array($user->role_id, $roleIds)) {
            return redirect()->back()->with('error', 'You cannot update your role.');
        }

        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'password' => 'nullable|min:3|max:20',
            'image' => 'nullable|image|dimensions:max_width=1920,max_height=1080',
        ]);

        // Hash the password if provided and not null
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->input('password'));
        } else {
            // Remove the password from the validated data to avoid updating it
            unset($validated['password']);
        }

        // Update the user with the validated data
        $user->update($validated);

        // Sync the roles without detaching
        $user->roles()->sync($roleIds);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $file_extension = $image->getClientOriginalExtension();
            $path = $image->store('users', 'public');

            $user->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path,
            ]);
        }

        return redirect()->route('admin.users.edit', $user)->with('success', 'User has been updated.');
    }

    public function destroy(User $user)
    {
        $user->deleted = 1;
        $user->save();

        return redirect()->route('admin.users.index')->with('danger', 'User has been dezactivated.');
    }
}
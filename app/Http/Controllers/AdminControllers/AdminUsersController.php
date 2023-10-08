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
        'password' => 'required|min:8|max:20',
        'image' => 'nullable|file|mimes:jpg,png,webp,svg,jpeg|dimensions:max_width=300,max_height=300',
        'role_id' => 'required|numeric'
    ];

    public function index()
    {
        return view('admin_dashboard.users.index', [
            'users' => User::with('roles')->latest()->paginate(100)
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.users.create', [
            'roles' => Role::pluck('name', 'id'),
        ]);
    }

    public function store(Request $request)
    {
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

        return redirect()->route('admin.users.create')->with('success', 'User has been created.');
    }

    public function edit(User $user)
    {
        return view('admin_dashboard.users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name', 'id')
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
        // Transform the input role_id into an int (othewise it will be a string)
        $role_id = intval($request->input('role_id'));

        // Check if the user is trying to change their own role
        if ($user->id === auth()->id() && $role_id !== $user->role_id) {
            return redirect()->back()->with('error', 'You can not update your role.');
        }

        $this->rules['password'] = 'nullable|min:3|max:20';
        $this->rules['email'] = ['required', 'email', Rule::unique('users')->ignore($user)];

        $validated = $request->validate($this->rules);
        
        if($validated['password'] === null)
            unset($validated['password']);
        else 
            $validated['password'] = Hash::make($request->input('password'));

        $user->update($validated);

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

        return redirect()->route('admin.users.edit', $user)->with('success', 'User has been updated.');
    }
    
    public function destroy(User $user)
    {
        if($user->id === auth()->id())
            return redirect()->back()->with('error', 'You can not delete yourself.');

        $adminUser = User::whereHas('role', function($query) {
            $query->where('name', 'admin');
        })->first();

        // When you delete an user, the author of posts is set to admin
        foreach ($user->posts as $post) {
            $post->user_id = $adminUser->id;
            $post->save();
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User has been deleted.');
    }
}
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Route;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key constraints for users and enable it again.
        Schema::disableForeignKeyConstraints();

        \App\Models\User::truncate();
        \App\Models\Role::truncate();
        \App\Models\Category::truncate();
        \App\Models\Platform::truncate();
        \App\Models\Other::truncate();
        \App\Models\Post::truncate();
        \App\Models\Tag::truncate();
        \App\Models\Comment::truncate();
        \App\Models\Image::truncate();

        Schema::enableForeignKeyConstraints();

        // Create Roles and Users
        \App\Models\Role::factory(1)->create();
        \App\Models\Role::factory(1)->create(['name' => 'admin']);

        $blog_routes = Route::getRoutes();
        $permissions_ids = [];
        foreach ($blog_routes as $route) {
            if (strpos($route->getName(), 'admin') !== false) {
                $permission = \App\Models\Permission::create(['name' => $route->getName()]);
                $permissions_ids[] = $permission->id;
            }            
        }
        
        \App\Models\Role::where('name', 'admin')->first()->permissions()->sync( $permissions_ids );
        
        $users = \App\Models\User::factory(1)->create([
            'name' => 'Lau',
            'email' => 'laurentiucozma12@gmail.com',
            'role_id' => 2
        ]);
        $users = \App\Models\User::factory(10)->create();

        foreach ($users as $user)
        {
            $user->image()->save( \App\Models\Image::factory()->make() );
        }

        \App\Models\Category::factory(1)->create(['name' => 'uncategorized', 'slug' => 'uncategorized']);
        \App\Models\Category::factory(10)->create();

        \App\Models\Platform::factory(1)->create(['name' => 'uncategorized', 'slug' => 'uncategorized', 'user_id' => 1]);
        \App\Models\Platform::factory(1)->create(['name' => 'pc', 'slug' => 'pc-games', 'user_id' => 1]);
        \App\Models\Platform::factory(1)->create(['name' => 'playstation', 'slug' => 'playstation', 'user_id' => 1]);
        \App\Models\Platform::factory(1)->create(['name' => 'xbox', 'slug' => 'xbox', 'user_id' => 1]);
        \App\Models\Platform::factory(1)->create(['name' => 'mobile', 'slug' => 'mobile-games', 'user_id' => 1]);
        \App\Models\Platform::factory(1)->create(['name' => 'nintendo', 'slug' => 'nintendo', 'user_id' => 1]);

        \App\Models\Other::factory(1)->create(['name' => 'uncategorized', 'slug' => 'uncategorized']);
        \App\Models\Other::factory(10)->create();

        $posts = \App\Models\Post::factory(200)->create(['approved' => true]);;

        \App\Models\Comment::factory(100)->create();

        \App\Models\Tag::factory(10)->create();

        foreach($posts as $post) 
        {
            $platforms_ids = [];
            $platforms_ids[] = \App\Models\Platform::all()->random()->id;
            $platforms_ids[] = \App\Models\Platform::all()->random()->id;
            $platforms_ids[] = \App\Models\Platform::all()->random()->id;
            $post->platforms()->sync( $platforms_ids );

            $platforms_ids = [];
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $post->tags()->sync( $tags_ids );

            $post->image()->save( \App\Models\Image::factory()->make() );
        }

        \App\Models\About::factory(1)->create();
    }
}

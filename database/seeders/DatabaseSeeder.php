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
        \App\Models\VideoGame::truncate();
        \App\Models\Category::truncate();
        \App\Models\Platform::truncate();
        \App\Models\Post::truncate();
        \App\Models\Tag::truncate();
        \App\Models\Image::truncate();

        Schema::enableForeignKeyConstraints();

        // Create Roles
        $user_role = \App\Models\Role::factory()->create(['name' => 'user']);
        $admin_role = \App\Models\Role::factory()->create(['name' => 'admin']);

        // Create Permissions
        $blog_routes = Route::getRoutes();
        $permissions_ids = [];

        foreach ($blog_routes as $route) {
            if (strpos($route->getName(), 'admin') !== false) {
                $permissionName = $route->getName();

                // Check if the permission already exists
                $existingPermission = \App\Models\Permission::where('name', $permissionName)->first();

                if (!$existingPermission) {
                    // Permission doesn't exist, create it
                    $permission = \App\Models\Permission::create(['name' => $permissionName]);
                    $permissions_ids[] = $permission->id;
                }
            }
        }
        
        \App\Models\Role::where('name', 'admin')->first()->permissions()->sync( $permissions_ids );
        
        // Assign the 'admin' role to your account for faster testing
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Hymerra',
            'email' => 'laurentiucozma12@gmail.com',
        ]);

        $adminUser->roles()->attach($admin_role->id);

        // Create Users
        $users = \App\Models\User::factory(10)->create();

        // Attach roles to users
        $users->each(function ($user) use ($user_role) {
            $user->roles()->attach($user_role->id);
        });

        $video_games = \App\Models\VideoGame::factory(10)->create();

        foreach ($video_games as $video_game)
        {
            $video_game->image()->save( \App\Models\Image::factory()->make() );
        }

        $categories = \App\Models\Category::factory(10)->create();

        foreach ($categories as $category)
        {
            $category->image()->save( \App\Models\Image::factory()->make() );
        }
        
        $platformsData = [
            (object)['name' => 'PC', 'slug' => 'pc'],
            (object)['name' => 'PlayStation', 'slug' => 'playstation'],
            (object)['name' => 'Xbox', 'slug' => 'xbox'],
            (object)['name' => 'Mobile', 'slug' => 'mobile'],
            (object)['name' => 'Nintendo', 'slug' => 'nintendo'],
        ];
        
        foreach ($platformsData as $platform) {
            $platform = \App\Models\Platform::factory()->create([
                'name' => $platform->name,
                'slug' => $platform->slug,
            ]);

            $platform->image()->save( \App\Models\Image::factory()->make() );
        }

        $posts = \App\Models\Post::factory(10)->create(['deleted' => 0]);

        \App\Models\Tag::factory(1)->create();
        
        foreach ($posts as $post) {
            $categories_ids = [];
            $categories_ids[] = \App\Models\Category::all()->random()->id;
            $categories_ids[] = \App\Models\Category::all()->random()->id;
            $categories_ids[] = \App\Models\Category::all()->random()->id;
            $post->video_game->categories()->sync($categories_ids);
        
            $platforms_ids = [];
            $platforms_ids[] = \App\Models\Platform::all()->random()->id;
            $platforms_ids[] = \App\Models\Platform::all()->random()->id;
            $platforms_ids[] = \App\Models\Platform::all()->random()->id;
            $post->video_game->platforms()->sync($platforms_ids);
        
            $tags_ids = [];
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $post->tags()->sync($tags_ids);
        
            $post->image()->save(\App\Models\Image::factory()->make());
        }

        \App\Models\About::factory(1)->create();

        $seo_home = \App\Models\Seo::factory()->create([
            'page_name' => 'Home',
            'title' => 'Latest News in Gaming - Epic Game News',
            'description' => 'Explore the latest and most exciting gaming news at EpicGameNews.com. Stay updated on the hottest releases, industry trends, and in-depth game reviews. Immerse yourself in a world of gaming insights, expert analyses, and exclusive content. Your ultimate destination for everything gaming awaits!',
            'keywords' => 'gaming news, video game releases, industry trends, game reviews, esports updates, gaming community, gaming culture, latest game announcements, game analysis, Epic Game News, gaming updates, console news, PC gaming, multiplayer games, gaming events',
        ]);

        // Video Game Page
        $seo_video_game = \App\Models\Seo::factory()->create([
            'page_name' => 'Video Game',
            'title' => 'Explore the Latest Video Games: News, Reviews, and Updates only at EpicGameNews.com',
            'description' => 'Stay in the loop with EpicGameNews.com! Discover the latest video games, read insightful reviews, and stay updated with gaming news and trends. Your ultimate destination for gaming enthusiasts.',
            'keywords' => 'epicgamenews.com, popular video games, video games news, latest game releases, gaming reviews',
        ]);

        // Category Page
        $seo_category = \App\Models\Seo::factory()->create([
            'page_name' => 'Category',
            'title' => 'Dive into Exciting Gaming Categories at EpicGameNews.com',
            'description' => 'Explore diverse gaming categories at EpicGameNews.com. From action-packed adventures to strategic challenges, find your favorite video game genres and discover new gaming worlds.',
            'keywords' => 'video game genres, gaming categories, explore gaming types, epicgamenews.com categories, popular game genres, gaming variety',
        ]);

        // Platform Page
        $seo_platform = \App\Models\Seo::factory()->create([
            'page_name' => 'Platform',
            'title' => 'Discover Gaming Excellence on Leading Platforms at EpicGameNews.com',
            'description' => 'Explore the best gaming experiences on various platforms at EpicGameNews.com. From top-notch console exclusives to PC gaming insights, find the perfect platform for your gaming adventures.',
            'keywords' => 'gaming platforms, video game consoles, pc, playstation, xbox, mobile, gaming devices',
        ]);

        // About Page
        $seo_about = \App\Models\Seo::factory()->create([
            'page_name' => 'About',
            'title' => 'About us - Epic Game News',
            'description' => 'Wanna know more about us? Checkout About page.',
            'keywords' => 'about us, epicgamenews.com, epic game news, epicgamenews, about',
        ]);

        // Contact Page
        $seo_contact = \App\Models\Seo::factory()->create([
            'page_name' => 'Contact',
            'title' => 'Contact us - Epic Game News',
            'description' => 'Wanna contact us? Complete a form on Contact page.',
            'keywords' => 'contact us, epicgamenews.com, epic game news, epicgamenews, contact',
        ]);

        // Privacy Policy Page
        $seo_privacy_policy = \App\Models\Seo::factory()->create([
            'page_name' => 'Privacy',
            'title' => '',
            'description' => '',
            'keywords' => '',
        ]);

        // Login Page
        $seo_login = \App\Models\Seo::factory()->create([
            'page_name' => 'Login',
            'title' => '',
            'description' => '',
            'keywords' => '',
        ]);

        // Register Page
        $seo_register = \App\Models\Seo::factory()->create([
            'page_name' => 'Register',
            'title' => '',
            'description' => '',
            'keywords' => '',
        ]);
    }
}
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
            $video_game->image()->save( \App\Models\Image::factory()->make());

            // Attach SEO title, description, and keywords
            $video_game->seo()->create([
                'page_type' => 'video_game',
                'page_name' => 'Related Video Game',
                'seo_name' => $video_game->name,
                'seo_title' => 'News about ' . $video_game->name . ' Video Game | Epic Game News',                
                'seo_description' => 'Find gaming news filtered by the ' . $video_game->name . ' Video Game, only at Epic Game News',
                'seo_keywords' => $video_game->name,
            ]);
        }

        $categories = \App\Models\Category::factory(10)->create();

        foreach ($categories as $category)
        {
            $category->image()->save( \App\Models\Image::factory()->make() );

            // Attach SEO title, description, and keywords
            $category->seo()->create([
                'page_type' => 'category',
                'page_name' => 'Related Category',
                'seo_name' => $category->name,
                'seo_title' => 'Gaming news related to ' . $category->name . ' category | Epic Game News',                
                'seo_description' => 'Find gaming news filtered by the ' . $category->name . 'category, only at Epic Game News',
                'seo_keywords' => $category->name,
            ]);
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

            // Attach SEO title, description, and keywords
            $platform->seo()->create([
                'page_type' => 'platform',
                'page_name' => 'Related Platform',
                'seo_name' => $platform->name,
                'seo_title' => 'Gaming news related to ' . $platform->name . ' platform | Epic Game News',                
                'seo_description' => 'Find gaming news filtered by the ' . $platform->name . ' platform, only at at Epic Game News',
                'seo_keywords' => $platform->name,
            ]);
        }

        $posts = \App\Models\Post::factory(10)->create(['deleted' => 0]);

            $tags = \App\Models\Tag::factory(1)->create();

            foreach ($tags as $tag) {
                // Attach SEO title, description, and keywords
                $tag->seo()->create([
                    'page_type' => 'tag',
                    'page_name' => 'Related Tag',
                    'seo_name' => $tag->name,
                    'seo_title' => 'Gaming news related to  ' . $tag->name . ' tag | Epic Game News',
                    'seo_description' => 'Find gaming news filtered by the ' . $tag->name . ' tag, only at Epic Game News',
                    'seo_keywords' => $tag->name,
                ]);
            }
        
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
                        
            // Get the tag names associated with the post
            $tagNames = $post->tags->pluck('name')->toArray();

            // Convert the array of tag names into a comma-separated string
            $keywordsString = implode(', ', $tagNames);

            // Attach SEO title, description, and keywords
            $post->seo()->create([
                'page_type' => 'post',
                'page_name' => 'Post',
                'seo_name' => $post->title,
                'seo_title' => $post->title,
                'seo_description' => $post->excerpt,
                'seo_keywords' => $keywordsString,
            ]);
        }

        \App\Models\About::factory()->create([
            'description' => '
                <h2 style="line-height: 1;"><strong>Who are we?</strong></h2> <h4 style="line-height: 1;">Hello, fellow Gamers! I\'m a Gamer myself, with a passion for programming.</h4> <ul> <li>In November 2021 I started my journey as a "Self-Taught Programmer". Back then, I did not know if I will be good enough in this field or if I will like it. After being consistent for some time, I started liking it more and more.</li> <li>In June 2023 I decided I should learn more about Web Development, and I thought it\'s a good idea making something I like. So I decided to create this blog where I\'m writing about the games I play or about the news in the Gaming Community.</li> <li>In November 2023 I decided to start my Gaming Channel "Hymerra the Barbarian", where you can watch my GamePlays.</li> </ul> <h2 style="line-height: 1;"><strong>Our mission</strong></h2> <h4 style="line-height: 1;">My mission is to grow as a Gamer and Developer and I want to have a fun journey.</h4> <h2 style="line-height: 1;"><strong>Our Vission</strong></h2> <h4 style="line-height: 1;">I aspire one day to become a Game Developer and create funny video games.</h4>
            ',
        ]);               

        $seo_home = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Home',
            'seo_title' => 'Latest News in Gaming - Epic Game News',
            'seo_description' => 'Explore the latest and most exciting gaming news at EpicGameNews.com. Stay updated on the hottest releases, industry trends, and in-depth game reviews. Immerse yourself in a world of gaming insights, expert analyses, and exclusive content. Your ultimate destination for everything gaming awaits!',
            'seo_keywords' => 'gaming news, video game releases, industry trends, game reviews, esports updates, gaming community, gaming culture, latest game announcements, game analysis, Epic Game News, gaming updates, console news, PC gaming, multiplayer games, gaming events',
        ]);

        // Video Game Page
        $seo_video_game = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Video Game',
            'seo_title' => 'Explore the Latest Video Games: News, Reviews, and Updates only at EpicGameNews.com',
            'seo_description' => 'Stay in the loop with EpicGameNews.com! Discover the latest video games, read insightful reviews, and stay updated with gaming news and trends. Your ultimate destination for gaming enthusiasts.',
            'seo_keywords' => 'epicgamenews.com, popular video games, video games news, latest game releases, gaming reviews',
        ]);

        // Category Page
        $seo_category = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Category',
            'seo_title' => 'Dive into Exciting Gaming Categories at EpicGameNews.com',
            'seo_description' => 'Explore diverse gaming categories at EpicGameNews.com. From action-packed adventures to strategic challenges, find your favorite video game genres and discover new gaming worlds.',
            'seo_keywords' => 'video game genres, gaming categories, explore gaming types, epicgamenews.com categories, popular game genres, gaming variety',
        ]);

        // Platform Page
        $seo_platform = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Platform',
            'seo_title' => 'Discover Gaming Excellence on Leading Platforms at EpicGameNews.com',
            'seo_description' => 'Explore the best gaming experiences on various platforms at EpicGameNews.com. From top-notch console exclusives to PC gaming insights, find the perfect platform for your gaming adventures.',
            'seo_keywords' => 'gaming platforms, video game consoles, pc, playstation, xbox, mobile, gaming devices',
        ]);

        // About Page
        $seo_about = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'About',
            'seo_title' => 'About us - Epic Game News',
            'seo_description' => 'Wanna know more about us? Checkout About page.',
            'seo_keywords' => 'about us, epicgamenews.com, epic game news, epicgamenews, about',
        ]);

        // Contact Page
        $seo_contact = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Contact',
            'seo_title' => 'Contact us - Epic Game News',
            'seo_description' => 'Wanna contact us? Complete a form on Contact page.',
            'seo_keywords' => 'contact us, epicgamenews.com, epic game news, epicgamenews, contact',
        ]);

        // Privacy Policy Page
        $seo_privacy_policy = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Privacy',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
        ]);

        // Login Page
        $seo_login = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Login',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
        ]);

        // Register Page
        $seo_register = \App\Models\Seo::factory()->create([
            'page_type' => 'main',
            'page_name' => 'Register',
            'seo_title' => '',
            'seo_description' => '',
            'seo_keywords' => '',
        ]);
    }
}
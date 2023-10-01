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
        \App\Models\Other::truncate();
        \App\Models\Post::truncate();
        \App\Models\Tag::truncate();
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

        \App\Models\VideoGame::factory(1)->create(['name' => 'uncategorized', 'slug' => 'uncategorized']);
        $video_games = \App\Models\VideoGame::factory(30)->create();

        foreach ($video_games as $video_game)
        {
            $video_game->image()->save( \App\Models\Image::factory()->make() );
        }

        \App\Models\Category::factory(1)->create(['name' => 'uncategorized', 'slug' => 'uncategorized']);
        $categories = \App\Models\Category::factory(10)->create();

        foreach ($categories as $category)
        {
            $category->image()->save( \App\Models\Image::factory()->make() );
        }
        
        // \App\Models\Platform::factory(1)->create(['name' => 'uncategorized', 'slug' => 'uncategorized']);
        // \App\Models\Platform::factory(1)->create(['name' => 'PC', 'slug' => 'pc']);
        // \App\Models\Platform::factory(1)->create(['name' => 'PlayStation', 'slug' => 'playstation']);
        // \App\Models\Platform::factory(1)->create(['name' => 'Xbox', 'slug' => 'xbox']);
        // \App\Models\Platform::factory(1)->create(['name' => 'Mobile', 'slug' => 'mobile']);
        // \App\Models\Platform::factory(1)->create(['name' => 'Nintendo', 'slug' => 'nintendo']);
        
        $platformsData = [
            (object)['name' => 'uncategorized', 'slug' => 'uncategorized'],
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

        // \App\Models\Other::factory(1)->create(['name' => 'uncategorized', 'slug' => 'uncategorized']);
        // \App\Models\Other::factory(1)->create(['name' => 'Game Trailers', 'slug' => 'game-trailers']);
        // \App\Models\Other::factory(1)->create(['name' => 'Anime', 'slug' => 'anime']);
        // \App\Models\Other::factory(1)->create(['name' => 'Cartoons', 'slug' => 'cartoons']);
        // \App\Models\Other::factory(1)->create(['name' => 'Movies', 'slug' => 'movies']);
        // \App\Models\Other::factory(1)->create(['name' => 'Series', 'slug' => 'series']);
        // \App\Models\Other::factory(1)->create(['name' => 'Lists', 'slug' => 'lists']);
        
        $othersData = [
            (object)['name' => 'uncategorized', 'slug' => 'uncategorized'],
            (object)['name' => 'Game Trailers', 'slug' => 'game-trailers'],
            (object)['name' => 'Anime', 'slug' => 'anime'],
            (object)['name' => 'Cartoons', 'slug' => 'cartoons'],
            (object)['name' => 'Movies', 'slug' => 'movies'],
            (object)['name' => 'Series', 'slug' => 'series'],
            (object)['name' => 'Lists', 'slug' => 'lists'],
        ];
        
        foreach ($othersData as $other) {
            $other = \App\Models\Other::factory()->create([
                'name' => $other->name,
                'slug' => $other->slug,
            ]);

            $other->image()->save( \App\Models\Image::factory()->make() );
        }

        $posts = \App\Models\Post::factory(200)->create(['approved' => true]);;

        \App\Models\Tag::factory(10)->create();

        foreach($posts as $post) 
        {
            $categories_ids = [];
            $categories_ids[] = \App\Models\Platform::all()->random()->id;
            $categories_ids[] = \App\Models\Platform::all()->random()->id;
            $categories_ids[] = \App\Models\Platform::all()->random()->id;
            $post->categories()->sync( $categories_ids );

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

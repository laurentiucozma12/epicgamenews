<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Other;
use App\Models\Post; 
use App\Models\Tag;
use App\Models\VideoGame;
use PhpParser\Node\Expr\AssignOp\Plus;

use Intervention\Image\ImageManagerStatic as ImageManager;

class AdminPostsController extends Controller
{
    private $rules = [
        'title' => 'required|max:150',
        'slug' => 'required|max:150',
        'excerpt' => 'required|max:150',
        'video_game_id' => 'required|numeric',
        'thumbnail' => 'required|image|max:1920',
        'author_thumbnail' => 'nullable|max:150',
        'body' => 'required',
    ];

    public function index()
    {
        return view('admin_dashboard.posts.index', [
            'posts' => Post::latest()->paginate(100),
        ]);
    }

    public function create()
    {
        return view('admin_dashboard.posts.create', [
            'video_games' => VideoGame::all(),            
            'categories' => Category::all(),
            'platforms' => Platform::all(),
            'others' => Other::all(),
        ]);
    }

    public function store(Request $request)
    {
        $selectedVideoGame = $request->input('video_game_id'); // 1 is uncategorized
        $selectedCategories = $request->input('categories', []); // 1 is uncategorized
        $selectedPlatforms = $request->input('platforms', []); // 1 is uncategorized
        $selectedOther = $request->input('other_id'); // 1 is uncategorized
        
        if (($selectedVideoGame !== "1" && $selectedCategories[0] !== "1" && $selectedPlatforms[0] !== '1' &&  $selectedOther === "1") 
            // game name, categories of the game and plaforms that can be played on are required
        || ($selectedVideoGame !== "1" && $selectedCategories[0] === "1" && $selectedPlatforms[0] === '1' &&  $selectedOther !== "1")) {
            // or game name and other if the article is about something else related to a game (like an anime/movie/etc. based on a game)

            $validated = $request->validate($this->rules);        
            $validated['user_id'] = auth()->id();
            $post = Post::create($validated);
            
            if ($request->hasFile('thumbnail')) {

                $thumbnail = $request->file('thumbnail');
                $filename = $thumbnail->getClientOriginalName();
                $file_extension  = $thumbnail->getClientOriginalExtension();

                // Get the base64-encoded image data from the request
                $croppedImageData = $request->input('croppedImageData');

                // Decode the base64 data into binary format
                $croppedImageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));

                // Save the binary data as an image file using Laravel's Storage facade
                Storage::disk('public')->put('images/' . $filename, $croppedImageBinary);

                // Create an Intervention Image instance from the saved image
                $croppedImagePath = public_path('storage/images/' . $filename);
                $croppedImage = ImageManager::make($croppedImagePath);

                // Resize the cropped image (e.g., to 1280 x 720)
                $croppedImage->resize(1280 , 720, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // Set the desired locale to Romanian
                $now = now();
                $now->setLocale('ro_RO');
                
                // Format the date and time in Romanian format
                $formattedDate = $now->translatedFormat('Y-m-d-H-M-s');
                
                // Modify the filename to include author name and date
                $resizedImageName = $formattedDate . '-' . Auth::user()->name . '-' . $filename;

                // Save the resized image using Laravel's Storage facade
                $resizedImagePath = 'images/' . $resizedImageName;
                Storage::disk('public')->put($resizedImagePath, $croppedImage->stream());

                // START aici tre un if daca ii create sau update pt cand optimizez codul
                    // Delete the original image
                    $originalImagePath = 'images/' . $filename;
                    Storage::disk('public')->delete($originalImagePath);
                    
                    // Associate the image with the post
                    $post->image()->create([
                        'name' => $resizedImageName ,
                        'extension' => $file_extension,
                        'path' => $resizedImagePath,
                    ]);
                    dd($post->image());
                // END
            }

            // Attach categories and platforms IDs to the post
            $post->categories()->attach($selectedCategories);
            $post->platforms()->attach($selectedPlatforms);
            
            // Set video game and other IDs to the post
            $post->update(['video_game_id' => $selectedVideoGame]);
            $post->update(['other_id' => $selectedOther]);

            $tags = explode(',', $request->input('tags'));
            $tags_ids = [];
            foreach ($tags as $tag) {
                $tag = strtolower(trim($tag)); // Convert to lowercase
                $existingTag = Tag::firstOrNew(['name' => $tag]);

                if (!$existingTag->exists) {
                    $existingTag->name = $tag;
                    $existingTag->slug = Str::slug($tag, '-');
                    $existingTag->user_id = auth()->id();
                    $existingTag->save();
                }

                $tags_ids[] = $existingTag->id;
            }

            $post->tags()->sync($tags_ids);
            
            return redirect()->route('admin.posts.create')->with('success', 'Post has been created.');
        } else  {        
            return redirect()->back()->withInput()->withErrors(['all_fields' => '
                Articles must have a (video game, categories and platforms) OR (video game and others).
                Also do not forget to remove "uncategorized" from categories and platforms section after you choose at least one option.
                Example 1: An article about Witcher 3 goes in Witcher 3 (video game field), RPG & Action (categories field), PC & PlayStation & Xbox (platforms field), (and other filed must be set on "uncategorized").
                Example 2: An article about Witcher from Netflix Series goes in goes in Witcher 3 (video game field), Series (other filed), (and the rest remain on uncategorized).
            ']);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Post $post)
    {
        $tags = '';
        foreach ($post->tags as $key => $tag)
        {
            $tags .= $tag->name;
            if ($key !== count($post->tags) - 1) 
                $tags .= ', ';
        }

        // Pass all the categories and platforms
        $categories = Category::pluck('categories.name', 'categories.id');
        $platforms = Platform::pluck('platforms.name', 'platforms.id');

        // Pass the selected categories and platforms
        $selectedCategformIds = $post->categories->pluck('id')->toArray();
        $selectedPlatformIds = $post->platforms->pluck('id')->toArray();
        
        return view('admin_dashboard.posts.edit', [
            'post' => $post,
            'tags' => $tags,
            'video_games' => VideoGame::pluck('name', 'id'),
            'categories' => $categories,
            'selectedCategformIds' => $selectedCategformIds,
            'platforms' => $platforms,
            'selectedPlatformIds' => $selectedPlatformIds,
            'others' => Other::pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $selectedVideoGame = $request->input('video_game_id'); // 1 is uncategorized
        $selectedCategories = $request->input('categories', []); // 1 is uncategorized
        $selectedPlatforms = $request->input('platforms', []); // 1 is uncategorized
        $selectedOther = $request->input('other_id'); // 1 is uncategorized
        
        if (($selectedVideoGame !== "1" && $selectedCategories[0] !== "1" && $selectedPlatforms[0] !== '1' &&  $selectedOther === "1") 
            // game name, categories of the game and plaforms that can be played on are required
        || ($selectedVideoGame !== "1" && $selectedCategories[0] === "1" && $selectedPlatforms[0] === '1' &&  $selectedOther !== "1")) {
            // or game name and other if the article is about something else related to a game (like an anime/movie/etc. based on a game)
           
            $updateRules = $this->rules;
            $updateRules['thumbnail'] = 'nullable|image|max:1920';            
            $validated = $request->validate($updateRules);

            $validated['approved'] = $request->input('approved') !== null;            
            $post->update($validated);

            if ($request->hasFile('thumbnail')) {

                $thumbnail = $request->file('thumbnail');
                $filename = $thumbnail->getClientOriginalName();
                $file_extension  = $thumbnail->getClientOriginalExtension();

                // Get the base64-encoded image data from the request
                $croppedImageData = $request->input('croppedImageData');
                // Decode the base64 data into binary format
                $croppedImageBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedImageData));
                
                // Save the binary data as an image file using Laravel's Storage facade
                Storage::disk('public')->put('images/' . $filename, $croppedImageBinary);
                
                // Create an Intervention Image instance from the saved image
                $croppedImagePath = public_path('storage/images/' . $filename);
                $croppedImage = ImageManager::make($croppedImagePath);
                
                // Resize the cropped image (e.g., to 1280 x 720)
                $croppedImage->resize(1280 , 720, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // Format the date and time in Romanian format
                $now = now()->setTimezone('Europe/Bucharest');
                $formattedDate = $now->format('Y-m-d-H-i-s');
                
                // Modify the filename to include author name and date
                $resizedImageName = $formattedDate . '-' . Auth::user()->name . '-' . $filename;

                // Save the resized image using Laravel's Storage facade
                $resizedImagePath = 'images/' . $resizedImageName;
                Storage::disk('public')->put($resizedImagePath, $croppedImage->stream());
                
                // Delete the original image and original image path if it exists
                $originalImagePath = 'images/' . $filename;
                Storage::disk('public')->delete($originalImagePath);

                // Associate the image with the post
                $post->image()->update([
                    'name' => $filename,
                    'extension' => $file_extension,
                    'path' => $resizedImagePath,
                ]);
            }

            $categoryIds = $request->input('categories', []);
            $platformIds = $request->input('platforms', []);

            // Sync the new categories and platforms
            $post->categories()->sync($categoryIds);
            $post->platforms()->sync($platformIds);

            $tags = explode(',', $request->input('tags'));
            $tags_ids = [];
            foreach ($tags as $tag) {
                $tag = strtolower(trim($tag)); // Convert to lowercase
                $existingTag = Tag::firstOrNew(['name' => $tag]);

                if (!$existingTag->exists) {
                    $existingTag->name = $tag;
                    $existingTag->slug = Str::slug($tag, '-');
                    $existingTag->user_id = auth()->id();
                    $existingTag->save();
                }

                $tags_ids[] = $existingTag->id;
            }

            $post->tags()->sync($tags_ids);        
            
            // Save the changes to the post
            $post->video_game_id = $selectedVideoGame;
            $post->other_id = $selectedOther;
            $post->save();

            return redirect()->route('admin.posts.edit', $post)->with('success', 'Post has been updated with success');
        } else  {        
            return redirect()->back()->withInput()->withErrors(['all_fields' => '
                Articles must have a (video game, categories and platforms) OR (video game and others).
                Also do not forget to remove "uncategorized" from categories and platforms section after you choose at least one option.
                Example 1: An article about Witcher 3 goes in Witcher 3 (video game field), RPG & Action (categories field), PC & PlayStation & Xbox (platforms field), (and other filed must be set on "uncategorized").
                Example 2: An article about Witcher from Netflix Series goes in goes in Witcher 3 (video game field), Series (other filed), (and the rest remain on uncategorized).
            ']);
        }
    }

    public function destroy(Post $post)
    {
        $post->tags()->delete();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post has been deleted');
    }
}
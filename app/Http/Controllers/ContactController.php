<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use App\Models\Post;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Services\PostSearchService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{    
    protected $postSearchService;

    public function __construct(PostSearchService $postSearchService)
    {
        $this->postSearchService = $postSearchService;
    }
    
    public function create()
    {
        $seo = Seo::where('page_name', '=', 'Contact')->first();
        return view('contact', [
            'seo' => $seo,
        ]);
    }

    public function store()
    {
        $data = array();
        $data['success'] = 0;
        $data['errors'] = [];
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'nullable|min:5|max:50',
            'message' => 'required|min:5|max:500',
        ];

        $validated = Validator::make(request()->all(), $rules);

        if ($validated->fails()) 
        {
            $data['errors']['first_name'] = $validated->errors()->first('first_name');
            $data['errors']['last_name'] = $validated->errors()->first('last_name');
            $data['errors']['email'] = $validated->errors()->first('email');
            $data['errors']['subject'] = $validated->errors()->first('subject');
            $data['errors']['message'] = $validated->errors()->first('message');
        } 
        else 
        {
            $attributes = $validated->validated();    
            Contact::create($attributes);

            Mail::to( env("ADMIN_EMAIL") )->send(new ContactMail(
                $attributes['first_name'],
                $attributes['last_name'],
                $attributes['email'],
                $attributes['subject'],
                $attributes['message'],
            ));
            
            $data['success'] = 1;
            $data['message'] = 'Thank you for contacting us';
        }
    
        return response()->json($data);
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = $this->postSearchService->search($search);

        return view('home', compact('posts', 'search'));
    }
}

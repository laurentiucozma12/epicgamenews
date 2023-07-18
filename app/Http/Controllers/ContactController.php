<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Models\Contact;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store()
    {
        $data = array();
        $data['name'] = "Lau";
        return response()->json($data);

        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'subject' => 'nullable|min:5|max:50',
            'message' => 'required|min:5|max:500',
        ]);

        Contact::create($attributes);

        Mail::to( env("ADMIN_EMAIL") )->send(new ContactMail(
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['email'],
            $attributes['subject'],
            $attributes['message'],
        ));

        return redirect()->route('contact.create')->with('success', 'Your message has been sent');
    }
}

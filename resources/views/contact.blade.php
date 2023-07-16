@extends('layout')

@section('title', 'New Gaming News | Contact')

@section('content')

    <div class='global-message info d-none'></div>

    <div class="colorlib-contact">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-12 animate-box">
                    <h2>Contact Information</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-info-wrap-flex">
                                <div class="con-info">
                                    <p><span><i class="icon-location-2"></i></span> 198 West 21th Street, <br> Suite 721 New York NY 10016</p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                                </div>
                                <div class="con-info">
                                    <p><span><i class="icon-globe"></i></span> <a href="#">yourwebsite.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Message Us</h2>
                </div>

                <div class="col-md-6">
                    <form method="POST" action="{{ route('contact.store') }}" autocomplete="off" >
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-6">
                                <x-blog.form.input value='{{ old("first_name") }}' placeholder='Your Firstname' name="first_name" />
                                <small class='error text-danger first_name'></small>
                            </div>
                            <div class="col-md-6">
                                <x-blog.form.input value='{{ old("last_name") }}' placeholder='Your Lastname' name="last_name" />
                                <small class='error text-danger last_name'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input value='{{ old("email") }}' placeholder='Your Email' type='email' name="email" />
                                <small class='error text-danger email'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input value='{{ old("subject") }}' required='false' name="subject" placeholder='Your Subject' />
                                <small class='error text-danger subject'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.textarea value='{{ old("message") }}' placeholder='What you want to tell us.' name="message" />
                                <small class='error text-danger message'></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary send-message-btn">
                        </div>
                    </form>

                    <x-blog.message :status="'success'" />
                    
                </div>

                <div class="col-md-6">
                    <div id="map" class="colorlib-map"></div>
                </div>
            </div>
        </div>
    </div>
		
@endsection
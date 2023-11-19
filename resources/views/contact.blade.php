@extends('layout')

@section('title', 'Contact | Epic Game News')

@section('content')

    <div class='global-message info d-none'></div>

    <div class="colorlib-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Message Us</h2>
                </div>

                <div class="col-md-6">
                    <form action="https://formsubmit.co/contact@epicgamenews.com" method="POST">
                        @csrf

                        <div class="row form-group">
                            <div class="col-md-12 ">
                                <x-blog.form.input value='{{ old("first_name") }}' placeholder='Firstname' name="first_name" />
                                <small class='error text-danger first_name'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 ">
                                <x-blog.form.input value='{{ old("last_name") }}' placeholder='Lastname' name="last_name" />
                                <small class='error text-danger last_name'></small>
                            </div>                            
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input value='{{ old("email") }}' placeholder='Email' type='email' name="email" />
                                <small class='error text-danger email'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.textarea value='{{ old("message") }}' placeholder='Tell us something...' name="message" />
                                <small class='error text-danger message'></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary send-message-btn">
                        </div>
                    </form>

                    <x-blog.message :status="'success'" />

                    {{-- <form onsubmit="return false;" autocomplete="off" method="POST">
                        @csrf

                        <div class="row form-group">
                            <div class="col-md-12 ">
                                <x-blog.form.input value='{{ old("first_name") }}' placeholder='Firstname' name="first_name" />
                                <small class='error text-danger first_name'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 ">
                                <x-blog.form.input value='{{ old("last_name") }}' placeholder='Lastname' name="last_name" />
                                <small class='error text-danger last_name'></small>
                            </div>                            
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input value='{{ old("email") }}' placeholder='Email' type='email' name="email" />
                                <small class='error text-danger email'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.input value='{{ old("subject") }}' required='false' name="subject" placeholder='Subject' />
                                <small class='error text-danger subject'></small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <x-blog.form.textarea value='{{ old("message") }}' placeholder='Tell us something...' name="message" />
                                <small class='error text-danger message'></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary send-message-btn">
                        </div>
                    </form>

                    <x-blog.message :status="'success'" /> --}}
                    
                </div>
                <div class="col-md-6">
                    <div id="map" class="colorlib-map"></div>
                </div>
            </div>
        </div>
    </div>
    
@endsection


{{-- @section('custom_js')

    <script>

        $(document).on("click", '.send-message-btn', (evt) => {
            evt.preventDefault();
            let $this = evt.target;
            
            let csrf_token = $($this).parents("form").find("input[name='_token']").val();
            let first_name = $($this).parents("form").find("input[name='first_name']").val();
            let last_name = $($this).parents("form").find("input[name='last_name']").val();
            let email = $($this).parents("form").find("input[name='email']").val();
            let subject = $($this).parents("form").find("input[name='subject']").val();
            let message = $($this).parents("form").find("textarea[name='message']").val();

            let formData = new FormData();
            formData.append('_token', csrf_token);
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('email', email);
            formData.append('subject', subject);
            formData.append('message', message);

            $.ajax({
                url: "{{ route('contact.store') }}",
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(data) {
                    
                    if (data.success) 
                    {
                        $(".global-message").addClass('alert , alert-info');                        
                        $(".global-message").fadeIn();
                        $(".global-message").text(data.message);

                        clearData($($this).parents("form"), ['first_name', 'last_name', 'email', 'subject', 'message']);

                        setTimeout(() => {
                            $(".global-message").fadeOut();                        
                        }, 5000);
                    }
                    else
                    {
                        for (const error in data.errors)
                        {
                            $("small." + error).text(data.errors[error]);
                        }
                    }
                }
            });

        });

    </script>

@endsection --}}
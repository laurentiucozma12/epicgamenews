<x-mail::message>
# Visitor Message

Some Visitor left a message: <br>
Firstname: {{ $firstname }} <br>
Lastname: {{ $lastname }} <br>
Email: {{ $email }} <br>
Subject: {{ $subject }} <br>
Message: {{ $message }} <br>

<x-mail::button :url="''">
View Message
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

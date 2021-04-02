<!DOCTYPE html>
<html lang="en">
<head>
    <title>Domain and Hosting Management</title>
</head>
<body>
    <p>Dear {{$name}},</p>
    <h3 style="text-align: center;">{{ $details['title'] }}</h3>
    <p>{{ $details['body'] }}</p>
    <p>With Regards,<br/> An4Soft Pvt. Ltd.,<br/>Mid Baneshwor, Kathmandu</p>
</body>
</html>
{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Regards,<br>
An4Soft Pvt. Ltd.
@endcomponent --}}

<!DOCTYPE html>
<html 
lang="{{ str_replace('_', '-', app()->getLocale()) }}"
data-theme="forest"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AIP Assistant</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        

    </head>
    <body>

        <div id="app" class="min-w-full min-h-full">
            <app></app>

        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

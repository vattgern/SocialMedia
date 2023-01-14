<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
        </style>
        @vite('resources/css/app.css')
    </head>
    <body id="app">
        @vite('resources/js/app.js')
    </body>
</html>

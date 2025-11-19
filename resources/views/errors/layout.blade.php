<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- SCSS and JS -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body class="vh-100">
        <main>
            @yield('message')
        </main>
    </body>
</html>

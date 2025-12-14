<html>
<head>
    <title>AB Inventech - Innovating Wind Power</title>

    <!-- SCSS and JS -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>
<body>

@auth
<div id="app">
    <header>
        @include('components/sections/navigation')

        @include('components/sections/sidebar')
    </header>

    <main class="container">
        @yield('content')
    </main>

</div>

@stack('fixed-elements')

@endauth

</body>

</html>


<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- CSS and JS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<body>

<div id="app">
    <header>
        <div class="p-3 d-lg-none">
            <a href="#menu" class="btn fs-3">
                <span><i class="bi bi-list"></i></span>
            </a>
        </div>

        <nav id="menu">
            <ul>

                <li><x-elements.link href="/" title="Dashboard" icon="bi bi-house"></x-elements.link></li>

                @guest
                    <x-blocks.mmenu-dropdown title="Clients" icon="bi bi-building">
    {{--                    <li><x-elements.link title="Sites" href="{{ route('sites') }}" icon="bi bi-dot"></x-elements.link></li>--}}
    {{--                    <li><x-elements.link title="Users" href="{{ route('users') }}" icon="bi bi-dot"></x-elements.link></li>--}}
                        <li><x-elements.link title="login" href="{{ route('show.login') }}" icon="bi bi-dot"></x-elements.link></li>
                    </x-blocks.mmenu-dropdown>

                    <x-blocks.mmenu-dropdown title="Trainings" icon="bi bi-mortarboard">
                        <li><x-elements.link title="Upcoming trainings" href="/trainings/upcoming" icon="bi bi-dot"></x-elements.link></li>
    {{--                    <li><x-elements.link title="Completed trainings" :href="route('trainings.completed')" icon="bi bi-dot"></x-elements.link></li>--}}
    {{--                    <li><x-elements.link title="User groups" href="{{ route('training.users') }}" icon="bi bi-dot"></x-elements.link></li>--}}
                    </x-blocks.mmenu-dropdown>

                    <x-blocks.mmenu-dropdown title="Courses" icon="bi bi-journals">
    {{--                    <li><x-elements.link class="dropdown-item" title="Certificate" href="{{ route('certificate') }}" icon="bi bi-dot"></x-elements.link></li>--}}
                    </x-blocks.mmenu-dropdown>
                @endguest

    {{--            <x-blocks.mmenu-dropdown title="Clients">--}}
    {{--                <x-blocks.mmenu-dropdown title="Clients">--}}
    {{--                    <li><x-elements.link title="Test" href="/sites"></x-elements.link></li>--}}
    {{--                    <li><x-elements.link title="Test" href="/sites"></x-elements.link></li>--}}
    {{--                </x-blocks.mmenu-dropdown>--}}
    {{--            </x-blocks.mmenu-dropdown>--}}

                @auth
                    <li>
                        <x-blocks.form action="{{ route('logout') }}">
                            <button type="submit" class="border-0">Logout</button>
                        </x-blocks.form>
                    </li>

                    <span>Hi there, {{ Auth::user()->first_name }}</span>
                @endauth
            </ul>
        </nav>

        {{--    <ul class="nav justify-content-end">--}}
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" href="#">Link</a>--}}
        {{--        </li>--}}
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" href="#">Link</a>--}}
        {{--        </li>--}}
        {{--    </ul>--}}
    </header>

    <main class="container margin-screen">
        @yield('content')
    </main>
</div>

</body>

</html>


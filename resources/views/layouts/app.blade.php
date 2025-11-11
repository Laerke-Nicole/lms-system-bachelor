<html>
<head>
    <title>AB Inventech</title>

    <!-- SCSS and JS -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>
<body>

<div id="app">
    <header>
        <div class="p-3 d-flex align-items-center justify-content-between justify-content-lg-end">
            <a href="#menu" class="btn fs-3 d-lg-none">
                <span><i class="bi bi-list"></i></span>
            </a>

            <ul class="list-unstyled d-flex mb-0">
                <li class="nav-item">
                    <a class="nav-link fs-5" href="#">
                        <i class="bi bi-person-circle me-2 fs-4"></i>
                        <span class="me-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </span>
                        <i class="bi bi-three-dots-vertical"></i>
                    </a>
                </li>
            </ul>
        </div>

        <nav id="menu">
            <ul>

                <li><x-elements.link href="/" title="Dashboard" icon="bi bi-house"></x-elements.link></li>

{{--                @guest--}}
{{--                @endguest--}}

                @auth
                    <x-blocks.mmenu-dropdown title="Clients" icon="bi bi-building">
                        <li><x-elements.link title="Companies" href="{{ route('companies.index') }}" icon="bi bi-dot"></x-elements.link></li>
                        <li><x-elements.link title="Sites" href="{{ route('sites.index') }}" icon="bi bi-dot"></x-elements.link></li>
{{--                        <li><x-elements.link title="Users" href="{{ route('users') }}" icon="bi bi-dot"></x-elements.link></li>--}}
                    </x-blocks.mmenu-dropdown>

                    <x-blocks.mmenu-dropdown title="Trainings" icon="bi bi-mortarboard">
                        <li><x-elements.link title="Upcoming trainings" href="{{ route('trainings.upcoming') }}" icon="bi bi-dot"></x-elements.link></li>
                        <li><x-elements.link title="Completed trainings" :href="route('trainings.past')" icon="bi bi-dot"></x-elements.link></li>
    {{--                    <li><x-elements.link title="User groups" href="{{ route('training.users') }}" icon="bi bi-dot"></x-elements.link></li>--}}
                    </x-blocks.mmenu-dropdown>

                    <x-blocks.mmenu-dropdown title="Courses" icon="bi bi-journals">
                        <li><x-elements.link class="dropdown-item" title="Course" href="{{ route('courses.index') }}" icon="bi bi-dot"></x-elements.link></li>
{{--                        <li><x-elements.link class="dropdown-item" title="Certificate" href="{{ route('certificate') }}" icon="bi bi-dot"></x-elements.link></li>--}}
                    </x-blocks.mmenu-dropdown>

                    <li>
                        <x-blocks.form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">
                            <button type="submit" class="border-0 mb-0 mm-listitem__btn mm-listitem__text w-100 d-flex align-items-start">
                                <span><i class="bi bi-box-arrow-left me-2"></i></span> Logout</button>
                        </x-blocks.form>
                    </li>

                    <span>Hi there, {{ Auth::user()->first_name }}</span>
                @endauth
            </ul>
        </nav>
    </header>


    <img src="{{ asset('images/default-logo.png') }}" alt="Logo" class="logo">


    <main class="container margin-screen">
        @yield('content')
    </main>
</div>

</body>

</html>


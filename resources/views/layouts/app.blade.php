<html>
<head>
    <title>AB Inventech</title>

    <!-- SCSS and JS -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

</head>
<body>

@auth
<div id="app">
    <header>
        <div class="container py-3 mb-5 d-flex align-items-center justify-content-between justify-content-lg-end navbar">
{{--            left side of navbar with menu bar--}}
            <a href="#menu" class="btn fs-3 p-0 d-lg-none">
                <span><i class="bi bi-list"></i></span>
            </a>

{{--            right side of navbar --}}
            <div class="d-flex gap-2">
    {{--            quick access to booking, cruds etc --}}
                <div>
                    <li class="fs-5 d-flex align-items-center dropdown">
                        <a href="">
                            <i class="bi bi-bell me-2 fs-3"></i>
                        </a>
                    </li>
                </div>

    {{--            profile --}}
                <ul class="list-unstyled d-flex mb-0">
                    <x-blocks.dropdown dropdownTitle="" icon="bi bi-person" class="fs-5 d-flex align-items-center dropdown">
{{--                        users full name and email --}}
                        <li class="pt-2 px-3 text-dark">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</li>
                        <li class="pb-2 px-3 text-muted display-5">{{ auth()->user()->email }}</li>

                        <li><hr class="dropdown-divider"></li>

{{--                        link to sections on profile page--}}
                        <li><x-elements.link title="Personal information" href="{{ route('profiles.edit') }}" class="dropdown-item fs-5"></x-elements.link></li>
                        <li><x-elements.link title="Certificates" href="{{ route('profiles.certificates') }}" class="dropdown-item fs-5"></x-elements.link></li>

                        <li><hr class="dropdown-divider"></li>

{{--                        log out --}}
                        <li>
                            <x-blocks.form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">
                                <button type="submit" class="dropdown-item fs-5">Logout</button>
                            </x-blocks.form>
                        </li>
                    </x-blocks.dropdown>
                </ul>
            </div>
        </div>

        <nav id="menu" class="sidebar">
            <ul>

                <li><x-elements.link href="{{ route('home') }}" title="Dashboard" icon="bi bi-house"></x-elements.link></li>



                    @if( auth()->user()->role === 'admin' || auth()->user()->role === 'leader' )
                    <x-blocks.mmenu-dropdown title="Clients" icon="bi bi-building">
                        @if( auth()->user()->role === 'admin' )
                            <li><x-elements.link title="Companies" href="{{ route('companies.index') }}" icon="bi bi-dot"></x-elements.link></li>
                        @endif

                        <li><x-elements.link title="Sites" href="{{ route('sites.index') }}" icon="bi bi-dot"></x-elements.link></li>
{{--                        <li><x-elements.link title="Users" href="{{ route('users') }}" icon="bi bi-dot"></x-elements.link></li>--}}
                    </x-blocks.mmenu-dropdown>
                    @endif


                    <x-blocks.mmenu-dropdown title="Trainings" icon="bi bi-mortarboard">
                        @if( auth()->user()->role === 'admin' || auth()->user()->role === 'leader' )
                            <li><x-elements.link title="Trainings" href="{{ route('trainings.index') }}" icon="i bi-dot"></x-elements.link></li>
                        @elseif(auth()->user()->role === 'user')
                            <li><x-elements.link title="My trainings" href="{{ route('trainings.index') }}" icon="i bi-dot"></x-elements.link></li>
                        @endif
                        @if( auth()->user()->role === 'leader' )
                            <li><x-elements.link title="Book training" href="{{ route('trainings.bookings.course') }}" icon="i bi-dot"></x-elements.link></li>
                        @endif
                    </x-blocks.mmenu-dropdown>

                    @if( auth()->user()->role === 'admin' )
                        <x-blocks.mmenu-dropdown title="Courses" icon="bi bi-journals">
                            <li><x-elements.link class="dropdown-item" title="Course" href="{{ route('courses.index') }}" icon="bi bi-dot"></x-elements.link></li>
                        </x-blocks.mmenu-dropdown>
                    @endif

                    @if( auth()->user()->role === 'admin' )
                        <x-blocks.mmenu-dropdown title="Settings" icon="bi bi-info-circle">
                            <li><x-elements.link class="dropdown-item" title="AB Inventech" href="{{ route('ab_inventech.index') }}" icon="bi bi-dot"></x-elements.link></li>
                            <li><x-elements.link class="dropdown-item" title="GDPR" href="{{ route('gdprs.index') }}" icon="bi bi-dot"></x-elements.link></li>
                        </x-blocks.mmenu-dropdown>
                    @endif

{{--                    <li>--}}
{{--                        <x-blocks.form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">--}}
{{--                            <button type="submit" class="border-0 mb-0 mm-listitem__btn mm-listitem__text w-100 d-flex align-items-start">--}}
{{--                                <span><i class="bi bi-box-arrow-left me-2"></i></span> Logout</button>--}}
{{--                        </x-blocks.form>--}}
{{--                    </li>--}}
            </ul>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

</div>

@stack('fixed-elements')

@endauth

</body>

</html>


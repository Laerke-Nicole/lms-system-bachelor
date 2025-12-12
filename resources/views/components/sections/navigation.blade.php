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

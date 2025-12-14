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

<nav id="menu" class="sidebar">
    <ul>

        <li><x-elements.link href="{{ route('home') }}" title="Dashboard" icon="bi bi-house"></x-elements.link></li>

        @if( auth()->user()->role === 'admin' )
            <x-blocks.mmenu-dropdown title="Clients" icon="bi bi-building">
                <li><x-elements.link title="Companies" href="{{ route('companies.index') }}" icon="bi bi-dot"></x-elements.link></li>
                <li><x-elements.link title="Sites" href="{{ route('sites.index') }}" icon="bi bi-dot"></x-elements.link></li>
                <li><x-elements.link title="Participants" href="" icon="bi bi-dot"></x-elements.link></li>
            </x-blocks.mmenu-dropdown>
        @endif

        @if( auth()->user()->role === 'leader' )
            <li><x-elements.link title="Employees" href="" icon="bi bi-people"></x-elements.link></li>
        @endif

        @if( auth()->user()->role === 'admin' || auth()->user()->role === 'leader' )
            <x-blocks.mmenu-dropdown title="Trainings" icon="bi bi-mortarboard">
                <li><x-elements.link title="Trainings" href="{{ route('trainings.index') }}" icon="i bi-dot"></x-elements.link></li>
                @if( auth()->user()->role === 'leader' )
                    <li><x-elements.link title="Book training" href="{{ route('trainings.bookings.course') }}" icon="i bi-dot"></x-elements.link></li>
                @endif
            </x-blocks.mmenu-dropdown>
        @endif

        @if(auth()->user()->role === 'user')
            <li><x-elements.link title="My trainings" href="{{ route('trainings.index') }}" icon="i bi-mortarboard"></x-elements.link></li>
        @endif

        @if( auth()->user()->role === 'admin' )
            <x-blocks.mmenu-dropdown title="Courses" icon="bi bi-journals">
                <li><x-elements.link class="dropdown-item" title="Course" href="{{ route('courses.index') }}" icon="bi bi-dot"></x-elements.link></li>
            </x-blocks.mmenu-dropdown>
        @endif

        @if( auth()->user()->role === 'admin' )
            <x-blocks.mmenu-dropdown title="Settings" icon="bi bi-gear">
                <li><x-elements.link class="dropdown-item" title="AB Inventech" href="{{ route('ab_inventech.index') }}" icon="bi bi-dot"></x-elements.link></li>
                <li><x-elements.link class="dropdown-item" title="GDPR" href="{{ route('gdprs.index') }}" icon="bi bi-dot"></x-elements.link></li>
            </x-blocks.mmenu-dropdown>
        @endif

{{--        <li>--}}
{{--            <x-blocks.form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">--}}
{{--                <button type="submit" class="border-0 mb-0 mm-listitem__btn mm-listitem__text w-100 d-flex align-items-start">--}}
{{--                    <span><i class="bi bi-box-arrow-left me-2"></i></span> Logout</button>--}}
{{--            </x-blocks.form>--}}
{{--        </li>--}}
    </ul>
</nav>

<nav id="menu" class="sidebar">
    <ul>

        <li><x-elements.link href="{{ route('home') }}" title="Dashboard" icon="bi bi-house"></x-elements.link></li>

        @include('components/blocks/sidebar-clients')

        @include('components/blocks/sidebar-trainings')

        @include('components/blocks/sidebar-courses')

        @include('components/blocks/sidebar-settings')

{{--        <li>--}}
{{--            <x-blocks.form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">--}}
{{--                <button type="submit" class="border-0 mb-0 mm-listitem__btn mm-listitem__text w-100 d-flex align-items-start">--}}
{{--                    <span><i class="bi bi-box-arrow-left me-2"></i></span> Logout</button>--}}
{{--            </x-blocks.form>--}}
{{--        </li>--}}
    </ul>
</nav>

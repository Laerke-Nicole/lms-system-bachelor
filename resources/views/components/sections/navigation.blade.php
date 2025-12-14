<div class="container py-3 mb-5 d-flex align-items-center justify-content-between justify-content-lg-end navbar">
    {{--            left side of navbar with menu bar--}}
    @include('components/blocks/mmenu-menubar')

    {{--            right side of navbar --}}
    <div class="d-flex gap-2">
        {{--            quick access to booking, cruds etc --}}
        @if(auth()->user()->role === 'leader' || auth()->user()->role === 'admin')
            @include('components/blocks/quick-access-links')
        @endif

        {{--        notifications--}}
        @include('components/blocks/notification-dropdown')

        {{--            profile --}}
        @include('components/blocks/profile-dropdown')
    </div>
</div>

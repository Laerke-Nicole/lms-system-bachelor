<x-blocks.dropdown dropdownTitle="" icon="bi bi-plus-circle" class="fs-5 d-flex align-items-center dropdown">

    @if(auth()->user()->role === 'admin')
        {{--    for admins --}}
        @include('components/elements/quick-access-links-admin')
    @elseif(auth()->user()->role === 'leader')
        {{--    for leaders --}}
        @include('components/elements/quick-access-links-leader')
    @endif


</x-blocks.dropdown>

<x-blocks.dropdown dropdownTitle="" icon="bi bi-plus-circle" class="fs-5 d-flex align-items-center dropdown">

{{--    for admins --}}
    @if(auth()->user()->role === 'admin')
        @include('components/elements/quick-access-links-admin')
    @endif

{{--    for leaders --}}
    @if(auth()->user()->role === 'leader')
        @include('components/elements/quick-access-links-leader')
    @endif


</x-blocks.dropdown>

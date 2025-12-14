<x-blocks.dropdown dropdownTitle="" icon="bi bi-plus-circle" class="fs-5 d-flex align-items-center dropdown">

{{--    for admins --}}
    @if(auth()->user()->role === 'admin')
        @include('components/elements/quick-access-links-admin')
    @endif


</x-blocks.dropdown>

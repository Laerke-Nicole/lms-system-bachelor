@if( auth()->user()->role === 'admin' )
    <x-blocks.mmenu-dropdown title="Courses" icon="bi bi-journals">
        <li><x-elements.link class="dropdown-item" title="Course" href="{{ route('courses.index') }}" icon="bi bi-dot"></x-elements.link></li>
        <li><x-elements.link class="dropdown-item" title="Create new course" href="{{ route('courses.create') }}" icon="bi bi-dot"></x-elements.link></li>
    </x-blocks.mmenu-dropdown>
@endif

@if( auth()->user()->role === 'admin' )
    <li><x-elements.link class="dropdown-item" title="Courses" href="{{ route('courses.index') }}" icon="bi bi-journals"></x-elements.link></li>
@endif

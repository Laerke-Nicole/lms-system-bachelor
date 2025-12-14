@if( auth()->user()->role === 'leader' )
    <x-blocks.mmenu-dropdown title="Trainings" icon="bi bi-mortarboard">
        <li><x-elements.link title="Trainings" href="{{ route('trainings.index') }}" icon="bi bi-dot"></x-elements.link></li>
        <li><x-elements.link title="Book training" href="{{ route('trainings.bookings.course') }}" icon="bi bi-dot"></x-elements.link></li>
    </x-blocks.mmenu-dropdown>
@endif

@if( auth()->user()->role === 'admin' )
    <li><x-elements.link title="Trainings" href="{{ route('trainings.index') }}" icon="bi bi-mortarboard"></x-elements.link></li>
@endif

@if(auth()->user()->role === 'user')
    <li><x-elements.link title="My trainings" href="{{ route('trainings.index') }}" icon="bi bi-mortarboard"></x-elements.link></li>
@endif

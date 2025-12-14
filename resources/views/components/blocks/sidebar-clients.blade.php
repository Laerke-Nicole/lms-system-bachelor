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

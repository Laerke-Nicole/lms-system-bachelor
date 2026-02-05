@if( auth()->user()->role === 'admin' )
    <x-blocks.mmenu-dropdown title="Settings" icon="bi bi-gear">
        <li><x-elements.link class="dropdown-item" title="AB Inventech" href="{{ route('ab_inventech.index') }}" icon="bi bi-dot"></x-elements.link></li>
        <li><x-elements.link class="dropdown-item" title="Admin" href="{{ route('admins.index') }}" icon="bi bi-dot"></x-elements.link></li>
        <li><x-elements.link class="dropdown-item" title="GDPR" href="{{ route('gdprs.index') }}" icon="bi bi-dot"></x-elements.link></li>
    </x-blocks.mmenu-dropdown>
@endif

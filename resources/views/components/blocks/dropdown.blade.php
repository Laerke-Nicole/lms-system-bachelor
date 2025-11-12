<li class="{{ $class ?? 'dropdown' }}">
    @isset($icon)
        <i class="{{ $icon }} me-2 fs-4"></i>
    @endisset
    <a href="{{ $attributes->get('href') }}" class="{{ $class ?? null }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $dropdownTitle }}
    </a>

    <ul class="dropdown-menu">
        {{ $slot }}
    </ul>
</li>

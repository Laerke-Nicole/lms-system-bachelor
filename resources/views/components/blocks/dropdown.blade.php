<li class="{{ $class ?? 'dropdown' }}">
    <a href="{{ $attributes->get('href') }}" class="{{ $class ?? null }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @isset($icon)
            <i class="{{ $icon }} me-2 fs-4"></i>
        @endisset
        {{ $dropdownTitle }}
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
        {{ $slot }}
    </ul>
</li>

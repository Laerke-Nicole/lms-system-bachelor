<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="{{ $attributes->get('href') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $dropdownTitle }}
    </a>
    <ul class="dropdown-menu">
        {{ $slot }}
    </ul>
</li>

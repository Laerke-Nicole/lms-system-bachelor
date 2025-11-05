<a class="{{ $class ?? null }}" href="{{ $attributes->get('href') }}">
    @isset($icon)
        <i class="{{ $icon }} me-2"></i>
    @endisset
        {{ $title }}
</a>

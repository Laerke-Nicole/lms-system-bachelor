<li><span>
        @isset($icon)
            <i class="{{ $icon }} me-2"></i>
        @endisset
        {{ $title }}
    </span>
    <ul>
        {{ $slot }}
    </ul>
</li>

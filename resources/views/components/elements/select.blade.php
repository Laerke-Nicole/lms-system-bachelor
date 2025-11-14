<div class="{{ $col ?? 'col-12 col-lg-4' }}">
    <div class="form-group mb-3">
        <label class="form-label ls-2 fs-6 text-uppercase" for="{{ $name }}">{{ $label }}</label>
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="{{ $class ?? 'form-select box-shadow-inset' }}"
            {{ $attributes->merge(['required' => true]) }}
        >
            {{ $slot }}
        </select>
    </div>
</div>

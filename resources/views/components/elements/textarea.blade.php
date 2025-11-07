<div class="{{ $col ?? 'col-12' }}">
    <div class="form-group mb-3">
        <label class="form-label ls-2 fs-6 text-uppercase" for="{{ $labelFor ?? null }}">{{ $label }}</label>
        <textarea
            name="{{ $name }}"
            class="{{ $class ?? 'form-control box-shadow-inset' }}"
            rows="{{ $rows ?? 4 }}"
            placeholder="{{ $placeholder ?? $label }}"
            {{ $attributes->merge(['required' => true]) }}
        >{{ old($name, $value ?? '') }}</textarea>
    </div>
</div>

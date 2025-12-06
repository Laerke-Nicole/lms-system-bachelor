<div class="{{ $col ?? 'col-12 col-lg-4' }}">
    <div class="form-group mb-3 {{ $formGroupClass ?? null }}">
        <label class="form-label {{ $labelClass ?? 'text-label-1'}}" for="{{ $labelFor ?? null }}">{{ $label }}</label>
        <input
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            class="{{ $class ?? 'form-control box-shadow-inset' }}"
            placeholder="{{ $placeholder ?? $label }}"
            {{ $attributes->merge(['required' => true]) }}
        >
    </div>
</div>

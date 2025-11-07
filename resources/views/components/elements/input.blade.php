<div class="{{ $col ?? 'col-12' }}">
    <div class="form-group mb-3">
        <label class="form-label text-label" for="{{ $labelFor ?? null }}">{{ $label }}</label>
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

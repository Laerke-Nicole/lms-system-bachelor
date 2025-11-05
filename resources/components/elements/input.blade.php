<div class="{{ $col ?? 'col-12' }}">
    <div class="form-group mb-3">
        <label class="form-label ls-2 fs-6 text-uppercase" for="{{ $labelFor ?? null }}">{{ $label }}</label>
        <input
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            class="{{ $class ?? 'form-control box-shadow-inset' }}"
            placeholder="{{ $placeholder ?? $label }}"
            {{ $required ?? false }}
        >
    </div>
</div>

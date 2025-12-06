<div class="{{ $col ?? 'col-12' }}">
    <div class="form-check mb-3 {{ $formGroupClass ?? '' }}">
        <input
            type="checkbox"
            name="{{ $name }}"
            value="{{ $value ?? 1 }}"
            class="form-check-input {{ $class ?? '' }}"
            {{ $attributes }}
        >
        <label class="form-label">{{ $label }}</label>
    </div>
</div>

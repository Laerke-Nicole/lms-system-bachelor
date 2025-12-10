<div class="{{ $col ?? 'col-12 col-lg-4' }}">
    <div class="form-group mb-3 {{ $formGroupClass ?? null }}">
        <label class="form-label {{ $labelClass ?? 'text-label-1'}}" for="{{ $labelFor ?? null }}">{{ $label }}</label>
        <div class="@if(($type ?? 'text') === 'password')position-relative @endif">
            <input
                type="{{ $type ?? 'text' }}"
                name="{{ $name }}"
                value="{{ old($name, $value ?? '') }}"
                class="{{ $class ?? 'form-control box-shadow-inset' }}"
                placeholder="{{ $placeholder ?? $label }}"
                {{ $attributes->merge(['required' => true]) }}>

            {{-- password toggle include --}}
            @if(($type ?? 'text') === 'password')
                @include('components.elements.password-toggle')
            @endif
        </div>
    </div>
</div>

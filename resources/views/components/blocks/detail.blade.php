@props(['isImage' => false, 'class' => null, 'title' => null, 'field'])

<div class="col-12">
    <div class="form-group d-flex flex-column">
        <strong class="text-dark {{ $class }}">{{ $field }}</strong>
        @if($isImage)
            @if($title)
                <img src="{{ asset('storage/' . $title) }}" alt="{{ basename($title) }}" class="{{ $imageClass ?? 'w-25' }}">
            @endif
        @else
            <p>{{ $title }}</p>
        @endif
    </div>
</div>

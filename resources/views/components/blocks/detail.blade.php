@props(['isImage' => false, 'class' => null, 'title' => null, 'field' => null, 'secondTitle' => null, 'thirdTitle' => null])

<div class="col-12">
    <div class="form-group d-flex">

        {{ $slot }}

        <div>
            <p class="text-dark mb-1 fs-4 {{ $class }}">{{ $field }}</p>
            @if($isImage)
                @if($title)
                    <img src="{{ asset('storage/' . $title) }}" alt="{{ basename($title) }}" class="{{ $imageClass ?? 'w-25 img-fluid mb-4' }}">
                @endif
            @else
                <p class="lh-md mb-4">{{ $title }} @if($secondTitle)<br>{{ $secondTitle }}@endif @if($thirdTitle)<br>{{ $thirdTitle }}@endif</p>
            @endif
        </div>
    </div>
</div>

@props(['isImage' => false, 'class' => null, 'title' => null, 'field' => null, 'secondTitle' => null, 'thirdTitle' => null, 'valueClass' => null])

<div class="{{ $col ?? 'col-12'}}">
    <div class="form-group">

        {{ $slot }}

        <dl class="row mb-3">
{{--            label --}}
            <dt class="col-sm-2 text-dark {{ $class }}">{{ $field }}</dt>

{{--            the value --}}
            <dd class="col-sm-10 {{ $valueClass ?? 'lh-md' }}">
                @if($isImage)
                    @if($title)
                        <img src="{{ asset('storage/' . $title) }}"
                             alt="{{ basename($title) }}"
                             class="{{ $imageClass ?? 'w-60 img-fluid' }}">
                    @endif
                @else
                        {{ $title }}

                        @if($secondTitle)
                            <br>{{ $secondTitle }}
                        @endif

                        @if($thirdTitle)
                            <br>{{ $thirdTitle }}
                        @endif
               @endif
            </dd>
        </dl>
    </div>
</div>

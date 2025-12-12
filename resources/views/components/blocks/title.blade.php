@props([
    'col',
    'title',
    'subTitle' => null,
    'linkTitle' => null,
    'buttonText' => null
])


<div class="row">
    <div class="margin-tb mb-4 {{ $col ?? 'col-lg-8' }}">
        <div>
            <h2>{{ $title }}</h2>

            @if($subTitle)
                <p>{{ $subTitle ?? null }}</p>
            @endif

            @if($linkTitle)
                <p><a href="{{ $attributes->get('link') }}"><u>{{ $linkTitle ?? null }}</u></a></p>
            @endif
        </div>

        @if($attributes->has('href'))
            <div>
                <a class="btn btn-primary" href="{{ $attributes->get('href') }}" target="{{ $target ?? null }}">{{ $buttonText ?? 'Submit' }}</a>
            </div>
        @endif
    </div>
</div>

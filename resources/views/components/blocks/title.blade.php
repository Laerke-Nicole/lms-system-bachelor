@props([
    'title',
    'subTitle' => null,
    'linkTitle' => null,
    'buttonText' => null
])


<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div>
            <h3>{{ $title }}</h3>

            @if($subTitle)
                <p>{{ $subTitle ?? null }}</p>
            @endif

            @if($linkTitle)
                <p><a href="{{ $attributes->get('link') }}"><u>{{ $linkTitle ?? null }}</u></a></p>
            @endif
        </div>

        @if($attributes->has('href'))
            <div>
                <a class="btn btn-primary" href="{{ $attributes->get('href') }}">{{ $buttonText ?? 'Submit' }}</a>
            </div>
        @endif
    </div>
</div>

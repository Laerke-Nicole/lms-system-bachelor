<div class="row">
    <div class="col-lg-12 margin-tb">
        <div>
            <h2>{{ $title }}</h2>
            <h4>{{ $tagline ?? null }}</h4>
        </div>

        @if(! $attributes->has('withoutButton'))
            <div class="mb-5">
                <a class="btn btn-primary" href="{{ $attributes->get('href') }}">{{ $buttonText ?? 'Submit' }}</a>
            </div>
        @endif
    </div>
</div>

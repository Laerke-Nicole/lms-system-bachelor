<div class="row">
    <div class="col-lg-12 margin-tb">
        <div>
            <h3>{{ $title }}</h3>
            <p>{{ $tagline ?? null }}</p>
        </div>

        @if(! $attributes->has('withoutButton'))
            <div class="mb-5">
                <a class="btn btn-primary" href="{{ $attributes->get('href') }}">{{ $buttonText ?? 'Submit' }}</a>
            </div>
        @endif
    </div>
</div>

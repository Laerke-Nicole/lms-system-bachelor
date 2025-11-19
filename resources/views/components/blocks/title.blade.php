<div class="row">
    <div class="col-lg-12 margin-tb mb-5">
        <div>
            <h3>{{ $title }}</h3>
            <p>{{ $tagline ?? null }}</p>
        </div>

        @if($attributes->has('href'))
            <div>
                <a class="btn btn-primary" href="{{ $attributes->get('href') }}">{{ $buttonText ?? 'Submit' }}</a>
            </div>
        @endif
    </div>
</div>

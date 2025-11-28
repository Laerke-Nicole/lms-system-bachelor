<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div>
            <h3>{{ $title }}</h3>
            <p>{{ $subTitle ?? null }}</p>
        </div>

        @if($attributes->has('href'))
            <div>
                <a class="btn btn-primary" href="{{ $attributes->get('href') }}">{{ $buttonText ?? 'Submit' }}</a>
            </div>
        @endif
    </div>
</div>

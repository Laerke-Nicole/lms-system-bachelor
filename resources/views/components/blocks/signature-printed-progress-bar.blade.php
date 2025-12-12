@props(['step', 'trainingUser'])

<div class="z-1 d-none d-md-block booking-progress-bar position-fixed bottom-0 start-0 end-0 bg-white shadow-lg pt-3 pb-4 px-4">

    {{-- progress line --}}
    <div class="position-relative mb-3">
        <div class="progress-line bg-light"></div>

        <div class="progress-line-fill bg-dark"
             style="width: calc(({{ $step }} - 1) / 2 * 100%);">
        </div>
    </div>

    {{-- steps --}}
    <div class="d-flex justify-content-between text-center">

        @if($step >= 1)
            <a href="{{ route('signatures.choose', ['trainingUser' => $trainingUser]) }}"
               class="text-decoration-underline-hover small {{ $step >= 1 ? 'fw-bold' : 'text-muted' }}" >
                Choose
            </a>
        @else
            <span class="small text-muted">
                Choose
            </span>
        @endif

        @if($step >= 2)
            <a href="{{ route('signatures.printed.printed', ['trainingUser' => $trainingUser]) }}"
               class="text-decoration-underline-hover small {{ $step >= 2 ? 'fw-bold' : 'text-muted' }}">
                Print, sign and upload
            </a>
        @else
            <span class="small text-muted">
                Print, sign and upload
            </span>
        @endif

        <span class="small {{ $step >= 3 ? 'fw-bold' : 'text-muted' }}">
            Done
        </span>

    </div>

</div>

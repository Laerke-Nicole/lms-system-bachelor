@props(['step'])

<div class="booking-progress-bar position-fixed bottom-0 w-100 bg-white shadow-lg pt-3 pb-4 px-3">

    {{-- Main progress line --}}
    <div class="position-relative mb-3 px-3">
        <div class="progress-line bg-light"></div>

        <div class="progress-line-fill bg-dark"
             style="width: calc(({{ $step }} - 1) / 3.80 * 100%);">
        </div>
    </div>

    {{-- Steps --}}
    <div class="d-flex justify-content-between text-center px-3">

        <a href="{{ route('trainings.bookings.course') }}"
           class="text-decoration-underline-hover small {{ $step >= 1 ? 'fw-bold' : 'text-muted' }}">
            Course
        </a>

        <a href="{{ route('trainings.bookings.slot') }}"
           class="text-decoration-underline-hover small {{ $step >= 2 ? 'fw-bold' : 'text-muted' }}">
            Time
        </a>

        <a href="{{ route('trainings.bookings.employees') }}"
           class="text-decoration-underline-hover small {{ $step >= 3 ? 'fw-bold' : 'text-muted' }}">
            Employees
        </a>

        <a href="{{ route('trainings.bookings.summary') }}"
           class="text-decoration-underline-hover small {{ $step >= 4 ? 'fw-bold' : 'text-muted' }}">
            Confirm
        </a>

        <span class="text-decoration-underline-hover small {{ $step == 5 ? 'fw-bold' : 'text-muted' }}">
            Done
        </span>
    </div>

</div>

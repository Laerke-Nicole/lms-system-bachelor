@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('bookings.employees') }}

<x-blocks.form action="{{ route('trainings.bookings.employees.store') }}" method="POST" x-data="{ loading: false }" @submit="loading = true">
    <div class="row booking-section">
        <div class="col-12 col-lg-7 booking-section-small">
            <h3 class="mb-4">Who is attending?</h3>

{{--            search, selectAll, clear and list of employees --}}
            @livewire('employee-selector', ['employees' => $employees])
        </div>

        <div class="col-12 col-lg-5">
            <div class="booking-summary">
                <div class="order-2 order-lg-1 small p-4 d-flex flex-column gap-2 bg-white rounded shadow-sm booking-section-small-always">
                    <h3>Booking summary</h3>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Course</p>
                        <p class="text-dark">{{ $course->title }}</p>
                    </div>

                    <div class="d-flex justify-content-between ">
                        <p class="text-muted">Duration</p>
                        <p class="text-dark">{{ $course->duration }} hrs</p>
                    </div>

                    <p class="mb-0">{{ $course->description }}</p>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Date</p>
                        <p class="text-dark">{{ $trainingSlot->training_date->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Trainer</p>
                        <p class="text-dark">{{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Location</p>
                        <p class="text-dark">{{ $trainingSlot->place }}</p>
                    </div>

                    <div class="d-flex flex-column">
                        <button type="submit" class="btn btn-primary" :disabled="loading">
                            <span x-show="!loading">Continue</span>
                            <span x-show="loading" class="spinner-border spinner-border-sm"></span>
                        </button>
                    </div>
                </div>

                <div class="order-1 order-lg-2 alert alert-primary small" role="alert">
                    Missing employees? <a href="#" class="fw-semibold text-decoration-underline">Register new employees here</a>.
                </div>
            </div>
        </div>
    </div>
</x-blocks.form>


@endsection

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="3" />
@endpush

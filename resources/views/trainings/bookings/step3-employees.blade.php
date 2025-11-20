@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('bookings.employees') }}

<div class="row booking-section">
    <div class="col-12 col-lg-7 booking-section-small">
        <div class="row">
            <h3 class="mb-4">Who is attending?</h3>

            <x-blocks.error-alert />

            <x-blocks.form action="{{ route('trainings.bookings.employees.store') }}" method="POST">
                @foreach($employees as $employee)
                    <div class="row g-3">
                        <div class="col-12 col-lg-4">
                            <label class="d-flex py-3">
                                <div class="d-flex gap-3">
                                    {{-- checkbox --}}
                                    <input type="checkbox"
                                           name="user_ids[]"
                                           value="{{ $employee->id }}"
                                           class="form-check-input">
                                    {{-- name and email of the employee --}}
                                    <div>
                                        <h5 class="mb-1 fw-semibold">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                                        <p class="text-muted small mb-0">{{ $employee->email }}</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                @endforeach


                <button type="submit" class="btn btn-primary mt-3">Continue</button>

            </x-blocks.form>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="small p-4 d-flex flex-column gap-2 bg-white rounded shadow-sm">
            <h3>Booking summary</h3>
            <div class="d-flex justify-content-between">
                <p class="text-muted">Course</p>
                <p class="text-dark">{{ $course->title }}</p>
            </div>

            <div class="d-flex justify-content-between ">
                <p class="text-muted">Duration</p>
                <p class="text-dark">8 hrs</p>
                {{--            <p>{{ $course->duration }}</p>--}}
            </div>

            <p class="text-dark mb-0 text-end">{{ $course->description }}</p>

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

            <div class="d-flex">
                <button type="submit" class="btn btn-primary">Continue</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="3" />
@endpush

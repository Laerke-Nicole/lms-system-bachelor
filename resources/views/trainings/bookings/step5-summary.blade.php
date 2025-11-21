@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render('bookings.summary') }}--}}

    <p class="fs-5 mb-2 text-primary">Booking successful</p>
    <h3 class="fs-60 mb-3">Thanks for booking</h3>
    <p class="fs-4 mb-5">We have received your booking. You can see it in your upcoming trainings tab.</p>

    <div class="row booking-section">
        <div class="col-12 col-lg-8 booking-section-small">
            <div class="small p-4 d-flex flex-column bg-white rounded shadow-sm">
                <div class="row mb-3 g-3">
                    <div class="col-sm-3">
                        <img src="{{ asset('storage/' . $training->trainingSlot->course->image) ?? '/placeholder.png' }}"
                             alt="{{ $training->trainingSlot->course->title }}"
                             class="h-100 w-100 object-fit-cover rounded">
                    </div>

                    <div class="col-sm-9 d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="fw-semibold">{{ $training->trainingSlot->course->title }}</h4>
                            <p>{{ $training->trainingSlot->course->description }}</p>
                        </div>
                        <div class="d-flex">
                            <p class="mb-0"><strong>Date</strong>{{ $training->trainingSlot->training_date->format('d M Y, H:i') }}</p>
                            <p class="mb-0"><strong>Location</strong> {{ $training->trainingSlot->place }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex flex-column gap-2 mt-3">
                    <h5 class="text-label-1">Training details</h5>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Trainer</p>
                        <p class="text-dark">{{ $training->trainingSlot->trainer->first_name }} {{ $training->trainingSlot->trainer->last_name }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="text-muted">Location</p>
                        <p class="text-dark">{{ $training->trainingSlot->place }}</p>
                    </div>
                </div>

                <hr>

                <div class="d-flex flex-column gap-2 mt-3 mb-3">
                    <h5 class="text-label-1">Participants</h5>
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <div>
                            @foreach($training->users as $user)
                                <p class="text-dark text-end">{{ $user->first_name }} {{ $user->last_name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Confirm booking</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="5" />
@endpush

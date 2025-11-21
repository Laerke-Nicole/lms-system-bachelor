@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('bookings.confirm') }}

    <h3 class="mb-4">Booking summary</h3>

    <div class="row booking-section">
        <div class="col-12 col-lg-8 booking-section-small">

            <x-blocks.error-alert />

            <x-blocks.form action="{{ route('trainings.bookings.confirm.store') }}" method="POST" class="mb-0">

                <div class="small p-4 d-flex flex-column bg-white rounded shadow-sm">
                    <div class="row mb-2 g-3">
                        <div class="col-sm-4">
                            <img src="{{ asset('storage/' . $course->image) ?? '/placeholder.png' }}"
                                                    alt="{{ $course->title }}"
                                                    class="h-100 w-100 object-fit-cover rounded">
                        </div>

                        <div class="col-sm-8">
                            <h4 class="fw-semibold mb-3">{{ $course->title }}</h4>
                            <p class="mb-2">{{ $trainingSlot->training_date->format('d M Y, H:i') }}</p>
                            <p>8 hrs</p>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex flex-column gap-2 mt-2">
                        <h5 class="text-label-1">Training details</h5>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted">Trainer</p>
                            <p class="text-dark">{{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p class="text-muted mb-2">Location</p>
                            <p class="text-dark mb-2">{{ $trainingSlot->place }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex flex-column gap-2 mt-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-2">Participants</p>
                            </div>
                            <div>
                                @foreach($employees as $employee)
                                    <p class="text-dark text-end">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Confirm booking</button>
                    </div>
                </div>

            </x-blocks.form>
        </div>

        <div class="col-12 col-lg-4">
            <div class="small p-4 d-flex flex-column bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-3">Customer information</h4>
                    <a href=""><i class="bi bi-pencil"></i></a>
                </div>
                <div class="d-flex gap-2 flex-wrap mb-2">
                    <i class="bi bi-person"></i>
                    <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </div>
                <div class="d-flex gap-2 flex-wrap mb-2">
                    <i class="bi bi-envelope"></i>
                    <span>{{ Auth::user()->email }}</span>
                </div>
                <div class="d-flex gap-2 flex-wrap mb-2">
                    <i class="bi bi-telephone"></i>
                    <span>{{ Auth::user()->phone }}</span>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="4" />
@endpush

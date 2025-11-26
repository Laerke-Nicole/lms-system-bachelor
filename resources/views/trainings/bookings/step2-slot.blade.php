@extends('layouts.app')

@section('content')

{{ Breadcrumbs::render('bookings.slot') }}

<h3 class="mb-5">When do you want to book for?</h3>

<div class="row booking-section">
    <div class="col-12 col-lg-8 booking-section-small">
        <div class="row g-3 step-cards">
            @foreach($trainingSlots as $trainingSlot)
                <div class="col-12 col-md-6 col-lg-4">

                    <x-blocks.error-alert />

                    <x-blocks.form action="{{ route('trainings.bookings.slot.store') }}" method="POST" class="mb-0 w-100 d-flex flex-column">
                        <input type="hidden" name="training_slot_id" value="{{ $trainingSlot->id }}">

                        <button type="submit" class="step-cards__card w-100 border-0 bg-white rounded-3 shadow-sm text-start d-flex flex-column p-0">

                        <div class="position-relative">
                            <div class="position-absolute top-0 left-0 m-2 z-1">
                                <p class="badge text-bg-light text-label-2">{{ $trainingSlot->place }}</p>
                            </div>
                            <div class="step-cards__card__image-wrapper2 img-hover-scale">
                                <img src="{{ asset('storage/' . $trainingSlot->course->image) ?? '/placeholder.png' }}"
                                     alt="{{ $trainingSlot->course->title }}"
                                     class="step-cards__card__image-wrapper2__image object-fit-cover position-relative h-34 w-100">
                            </div>
                        </div>

                        <div class="p-3">
                            <p class="text-primary text-label-2 mb-1">{{ $trainingSlot->course->title }}</p>
                            <h4 class="mb-3">{{ $trainingSlot->training_date->format('d M Y, H:i') }}</h4>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <p class="fs-5 mb-0 text-muted">{{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}</p>
                                </div>

                                <div>
                                    <i class="bi bi-chevron-right text-primary"></i>
                                </div>
                            </div>
                        </div>
                        </button>
                    </x-blocks.form>
                </div>
            @endforeach
        </div>
    </div>

    @if($course->requirements->isNotEmpty())
        <div class="col-12 col-lg-4">
            <div class="booking-sidebar booking-requirements">
                <h3>Requirements and rules</h3>

                @foreach($course->requirements as $requirement)
                    @if($requirement->title)
                        <h4 class="booking-requirements__title">{{ $requirement->title }}</h4>
                    @endif

                    @if($requirement->content)
                        <p class="booking-requirements__content">{{ $requirement->content }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection

@push('fixed-elements')
    <x-blocks.booking-progress-bar :step="2" />
@endpush

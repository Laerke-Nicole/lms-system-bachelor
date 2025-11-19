@extends('layouts.app')

@section('content')

<h3 class="mb-4">When do you want to book for?</h3>

<div class="row g-3 step-cards">
    @foreach($trainingSlots as $trainingSlot)
        <div class="col-12 col-md-6 col-lg-3">
            <x-blocks.form action="{{ route('trainings.bookings.slot.store') }}" method="POST" class="mb-0 w-100 d-flex flex-column">
            <input type="hidden" name="course_id" value="{{ $trainingSlot->id }}">

            <button type="submit" class="step-cards__card w-100 border-0 bg-white rounded-3 shadow-sm text-start d-flex flex-column">

                <div>
                    <div class="position-absolute top-0 left-0 m-1">
                        <p class="p-1 bg-light text-label">{{ $trainingSlot->place }}</p>
                    </div>
                    <div class="step-cards__card__image-wrapper2">
                        <img src="{{ asset('storage/' . $trainingSlot->course->image) ?? '/placeholder.png' }}"
                             alt="{{ $trainingSlot->course->title }}"
                             class="step-cards__card__image-wrapper2__image img-fluid object-fit-cover position-relative">
                    </div>
                </div>

                <div class="p-3">
                    <h4>{{ $trainingSlot->training_date }}</h4>
                    <p class="text-primary text-label">{{ $trainingSlot->course->title }}</p>

                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-center">
                            <i class="bi bi-person me-2"></i>
                            <p class="fs-5 mb-0">{{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}</p>
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

@endsection

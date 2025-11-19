@extends('layouts.app')

@section('content')

<h3 class="mb-4">Choose a course</h3>

<div class="row g-3 step1">
    @foreach($courses as $course)
        <div class="col-md-6 d-flex">
            <x-blocks.form action="{{ route('trainings.bookings.course.store') }}" method="POST" class="mb-0 w-100 d-flex flex-column">
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <button type="submit" class="step1__card w-100 border-0 bg-white rounded-3 shadow-sm text-start d-flex flex-column">

                    <div class="row g-3">
                        <div class="col-12 col-sm-5 px-0">
                            <div class="step1__card__image-wrapper h-100 img-hover-scale">
                                <img src="{{ asset('storage/' . $course->image) ?? '/placeholder.png' }}"
                                     alt="{{ $course->title }}"
                                     class="h-100 w-100 object-fit-cover step1__card__image-wrapper__image">
                            </div>
                        </div>

                        <div class="col-12 col-sm-7 d-flex flex-column justify-content-between px-3 pb-3 py-sm-3">
                            <div>
                                <h4>{{ $course->title }}</h4>
                                <p class="text-muted small">
                                    {{ Str::limit($course->description, 70) }}
                                </p>
                            </div>

                            <div class="text-end mt-2">
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

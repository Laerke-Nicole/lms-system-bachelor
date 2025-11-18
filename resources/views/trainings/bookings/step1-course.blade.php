@extends('layouts.app')

@section('content')

<h2 class="mb-4">Choose a course</h2>

<div class="row g-4">
    @foreach($courses as $course)
        <div class="col-md-6 col-lg-3">
            <x-blocks.form action="{{ route('trainings.bookings.course.store') }}" method="POST">
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <button type="submit" class="w-100 border-0 bg-white rounded-3 shadow-sm text-start">

                    <div class="row">
                        <div class="col-12 col-sm-5">
                            <div class="ratio h-30 overflow-hidden">
                                <img src="{{ asset('storage/' . $course->image) ?? '/placeholder.png' }}"
                                     alt="{{ $course->title }}"
                                     class="h-100 w-100 object-fit-cover">
                            </div>
                        </div>

                        <div class="col-12 col-sm-7 d-flex flex-column justify-content-between py-sm-3 pe-sm-3">
                            <div class="d-flex flex-column justify-content-center">
                                <div>
                                    <h5 class="mb-1 fw-semibold">{{ $course->title }}</h5>
                                    <p class="text-muted small">
                                        {{ Str::limit($course->description, 70) }}
                                    </p>
                                </div>

                                <div class="text-end mt-2">
                                    <i class="bi bi-chevron-right text-primary opacity-75"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </button>

            </x-blocks.form>
        </div>
    @endforeach
</div>


@endsection

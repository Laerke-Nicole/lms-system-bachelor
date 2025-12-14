@extends('layouts.app')


@section('content')

    <div class="row mb-5">
        <div class="col-12">
            <h2>Hi, {{ auth()->user()->first_name }}</h2>
            <p>Welcome, check your learning.</p>
        </div>
    </div>


{{--    admin dashboard --}}
    @include('components/sections/statistics')

@if(auth()->user()->role === 'admin')
    <div class="bg-white rounded-3 shadow-sm p-4 my-5">
        <h3 class="mb-4 fw-bold">Quick Access</h3>

        <div class="row g-4">

            {{-- Create Course --}}
            <div class="col-md-6">
                <a href="{{ route('courses.create') }}" class="text-decoration-none">
                    <div class="quick-card d-flex justify-content-between align-items-center p-4 border rounded-3 h-100">

                        <div>
                            <h4 class="fw-semibold mb-1">Create New Course</h4>
                            <p class="text-muted mb-0">Start building a new course and set up training details.</p>
                        </div>

                        <div class="icon-box bg-primary text-white">
                            <i class="bi bi-plus-lg"></i>
                        </div>

                    </div>
                </a>
            </div>

            {{-- Edit Courses --}}
            <div class="col-md-6">
                <a href="{{ route('courses.index') }}" class="text-decoration-none">
                    <div class="quick-card d-flex justify-content-between align-items-center p-4 border rounded-3 h-100">

                        <div>
                            <h4 class="fw-semibold mb-1">Manage Courses</h4>
                            <p class="text-muted mb-0">View, edit, and update existing courses.</p>
                        </div>

                        <div class="icon-box bg-secondary text-white">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                    </div>
                </a>
            </div>

        </div>
    </div>
@endif



{{--    showing section where the user participates--}}
    <x-sections.participate-in-training :participateTraining="$participateTraining" />
@endsection

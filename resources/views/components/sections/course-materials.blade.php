@extends('layouts.app')

@section('content')

    {{--    {{ Breadcrumbs::render('to-home', 'Course Materials', 'courses.course_materials.index') }}--}}

    @if($course)
        <x-blocks.title title="Course materials for {{ $course->title }}"/>
    @else
        <x-blocks.title title="Course Materials"/>
    @endif

        <div class="row g-4 px-xl-5 course-materials">
    @if($training->trainingSlot && $training->trainingSlot->course)
        @forelse ($training->trainingSlot->course->courseMaterials as $material)
            <div class="col-lg-4">
                <div class="d-flex flex-row">
                    <div>
{{--                        icon --}}
                        @if($material->type)
                            <div class="pe-none bg-primary text-light p-2 me-4 rounded-circle">
                                @if($material->type === 'Video')
                                    <i class="bi bi-camera-reels course-materials__icon"></i>
                                @elseif ($material->type === 'PDF')
                                    <i class="bi bi-file-earmark-pdf course-materials__icon"></i>
                                @elseif ($material->type === 'Task')
                                    <i class="bi bi-pencil course-materials__icon"></i>
                                @elseif ($material->type === 'Quiz')
                                    <i class="bi bi-patch-question course-materials__icon"></i>
                                @else
                                    <i class="bi bi-paperclip course-materials__icon"></i>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4>{{ $material->type }}</h4>
                        <p class="mb-2">{{ $material->title }}</p>
                        @if($material->type === 'PDF' && $material->pdf)
                            <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank" class="text-primary">
                                Download PDF
                            </a>
                        @elseif($material->url)
                            <a href="{{ $material->url }}" target="_blank" class="text-primary">
                                Open Material
                                <i class="bi bi-arrow-up-right ms-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No course materials available.</p>
        @endforelse
    @else
        <p class="text-muted">No course materials available.</p>
    @endif
    </div>

@endsection

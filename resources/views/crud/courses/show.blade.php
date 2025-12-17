@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Courses',
        'courses.index',
        'Show',
        'courses.show',
        $course
    ) }}


    <x-blocks.title title="{{ $course->title }} course" />

    <div class="row">
        <x-blocks.detail field="Title" title="{{ $course->title }}" />
        @if($course->description)
            <x-blocks.detail field="Description" title="{{ $course->description }}" />
        @endif
        @if($course->duration)
            <x-blocks.detail field="Duration" title="{{ $course->duration }} hrs" />
        @endif
        @if($course->duration_months)
            <x-blocks.detail field="Duration months" title="{{ $course->duration_months }}" />
        @endif
        @if($course->max_participants)
            <x-blocks.detail field="Max participants" title="{{ $course->max_participants }}" />
        @endif
        @if($course->evaluation && $course->evaluation->evaluation_link)
            <x-blocks.detail field="Evaluation link" title="{{ $course->evaluation->evaluation_link }}" />
        @endif
        @if($course->followUpTest && $course->followUpTest->test_link)
            <x-blocks.detail field="Follow up test link" title="{{ $course->followUpTest->test_link }}" />
        @endif
        @if($course->image)
            <x-blocks.detail field="Image" :isImage="true" :title="$course->image" />
        @endif
    </div>

@endsection

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
        <x-blocks.detail field="Description" title="{{ $course->description }}" />
        <x-blocks.detail field="Duration" title="{{ $course->duration }} hrs" />
        <x-blocks.detail field="Duration months" title="{{ $course->duration_months }}" />
        <x-blocks.detail field="Max participants" title="{{ $course->max_participants }}" />
        <x-blocks.detail field="Evaluation link" title="{{ $course->evaluation->evaluation_link }}" />
        <x-blocks.detail field="Follow up test link" title="{{ $course->followUpTest->test_link }}" />
        <x-blocks.detail field="Image" :isImage="true" :title="$course->image" />
    </div>

@endsection

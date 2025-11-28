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


    <x-blocks.title title="{{ $course->title }} course"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Title" title="{{ $course->title }}"></x-blocks.detail>
        <x-blocks.detail field="Description" title="{{ $course->description }}"></x-blocks.detail>
        <x-blocks.detail field="Duration" title="{{ $course->duration }} hrs"></x-blocks.detail>
        <x-blocks.detail field="Duration months" title="{{ $course->duration_months }}"></x-blocks.detail>
        <x-blocks.detail field="Max participants" title="{{ $course->max_participants }}"></x-blocks.detail>
        <x-blocks.detail field="Image" :isImage="true" :title="$course->image"></x-blocks.detail>
    </div>

@endsection

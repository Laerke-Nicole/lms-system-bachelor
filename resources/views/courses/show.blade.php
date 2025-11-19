@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('course', $course, 'View course') }}

    <x-blocks.title title="{{ $course->title }} course"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Title" title="{{ $course->title }}"></x-blocks.detail>
        <x-blocks.detail field="Description" title="{{ $course->description }}"></x-blocks.detail>
        <x-blocks.detail field="Duration months" title="{{ $course->duration_months }}"></x-blocks.detail>
        <x-blocks.detail field="Image" :isImage="true" :title="$course->image"></x-blocks.detail>
    </div>

@endsection

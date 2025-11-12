@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('courses.index') }}" title="{{ $course->title }} course"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Title" title="{{ $course->title }}"></x-blocks.detail>
        <x-blocks.detail field="Description" title="{{ $course->description }}"></x-blocks.detail>
        <x-blocks.detail field="Duration months" title="{{ $course->duration_months }}"></x-blocks.detail>
        <x-blocks.detail field="Image" :isImage="true" :title="$course->image"></x-blocks.detail>
    </div>

@endsection

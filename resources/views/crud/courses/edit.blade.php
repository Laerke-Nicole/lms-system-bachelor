@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Courses',
        'courses.index',
        'Edit',
        'courses.edit',
        $course
    ) }}

    <x-blocks.title title="Edit {{ $course->title }}" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $course->title }}" maxlength="255"/>
        <x-elements.textarea label="Description" name="description" value="{{ $course->description }}"/>
        <x-elements.input label="Duration" placeholder="Duration (in hours)" name="duration" type="number" value="{{ $course->duration }}"/>
        <x-elements.input label="Duration months" name="duration_months" type="number" value="{{ $course->duration_months }}"/>
        <x-elements.input label="Max participants" name="max_participants" type="number" value="{{ $course->max_participants }}"/>
        <x-elements.input label="Evaluation link" name="evaluation_link" type="url" value="{{ $course->evaluation_link }}" maxlength="2048"/>
        <x-elements.input label="Follow up test link" name="test_link" type="url" value="{{ $course->test_link }}" maxlength="2048"/>
        <x-elements.input label="Image" name="image" type="file" :required="false" />
        <div class="w-50 mb-5">
            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ basename($course->image) }}" class="'w-50 img-fluid">
        </div>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

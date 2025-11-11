@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('courses.index') }}" title="Edit course"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input col="col-12 col-lg-4" label="Title" name="title" value="{{ $course->title }}"/>
        <x-elements.textarea col="col-12 col-lg-4" label="Description" name="description" value="{{ $course->description }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Duration months" name="duration_months" type="number" value="{{ $course->duration_months }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Image" name="image" type="file" value="{{ $course->image }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

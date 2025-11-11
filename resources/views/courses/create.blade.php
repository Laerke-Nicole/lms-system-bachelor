@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('courses.index') }}" title="Add new course"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        <x-elements.input col="col-12 col-lg-4" label="Title" name="title" />
        <x-elements.textarea col="col-12 col-lg-4" label="Description" name="description" />
        <x-elements.input col="col-12 col-lg-4" label="Duration months" name="duration_months" type="number" />
        <x-elements.input col="col-12 col-lg-4" label="Image" name="image" type="file" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

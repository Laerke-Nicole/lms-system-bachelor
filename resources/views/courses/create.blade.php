@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('courses.index') }}" title="Add new course"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.store') }}" method="POST">
        <x-elements.input col="col-12 col-lg-4" label="Title" name="title" />
        <x-elements.textarea col="col-12 col-lg-4" label="Description" name="description" />
        <x-elements.input col="col-12 col-lg-4" label="Duration months" name="duration_months" type="number" />
        <x-elements.input col="col-12 col-lg-4" label="Image" name="image" type="file" />

        <button type="submit" class="btn btn-primary">Submit</button>
    </x-blocks.form>

@endsection

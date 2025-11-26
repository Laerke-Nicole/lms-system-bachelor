@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.create',
        'Courses',
        'courses.index',
        'Create',
        'courses.create'
    ) }}


    <x-blocks.title title="Create new course"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        <x-elements.input label="Title" name="title" />
        <x-elements.textarea label="Description" name="description" />
        <x-elements.input label="Duration (in hours)" name="duration" type="number" />
        <x-elements.input label="Duration months" name="duration_months" type="number" />
        <x-elements.input label="Image" name="image" type="file" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

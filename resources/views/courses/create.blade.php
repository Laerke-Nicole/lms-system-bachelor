@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.create',
        'Courses',
        'courses.index',
        'Create',
        'courses.create'
    ) }}


    <x-blocks.title title="Create new course" />

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        <x-elements.input label="Title" name="title" />
        <x-elements.textarea label="Description" name="description" />
        <x-elements.input label="Duration" placeholder="Duration (in hours)" name="duration" type="number" />
        <x-elements.input label="Duration months" name="duration_months" type="number" />
        <x-elements.input label="Max participants" name="max_participants" type="number" />
        <x-elements.input label="Evaluation link" name="evaluation_link" type="url" />
        <x-elements.input label="Follow up test link" name="test_link" type="url" />
        <x-elements.input label="Image" name="image" type="file" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

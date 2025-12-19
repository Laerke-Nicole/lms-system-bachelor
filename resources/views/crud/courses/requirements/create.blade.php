@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('courses.requirements.create', $course) }}

    <x-blocks.title title="Create new requirement" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('courses.requirements.store', $course) }}" method="POST">
        <x-elements.input label="Title" name="title" />
        <x-elements.textarea label="Content" name="content" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.requirements.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

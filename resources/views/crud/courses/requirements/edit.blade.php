@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('courses.requirements.edit', $course) }}

    <x-blocks.title title="Edit requirement {{ $requirement->title }}" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('courses.requirements.update', [$course, $requirement]) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $requirement->title }}" maxlength="255"/>
        <x-elements.textarea label="Content" name="content" value="{{ $requirement->content }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.requirements.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

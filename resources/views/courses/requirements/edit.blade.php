@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.show',--}}
{{--        'Courses.Requirements',--}}
{{--        'courses.requirements.index',--}}
{{--        'Edit',--}}
{{--        'courses.requirements.edit',--}}
{{--        $course--}}
{{--    ) }}--}}

    <x-blocks.title title="Edit requirement {{ $requirement->title }}"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.requirements.update', [$course, $requirement]) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $requirement->title }}"/>
        <x-elements.textarea label="Content" name="content" value="{{ $requirement->content }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.preparations.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

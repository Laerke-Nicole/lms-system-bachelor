@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.create',--}}
{{--        'Course Materials',--}}
{{--        'course_materials.index',--}}
{{--        'Create',--}}
{{--        'course_materials.create'--}}
{{--    ) }}--}}


    <x-blocks.title title="Create new course material" subTitle="Please fill out either a URL or upload a PDF." />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('courses.course_materials.store', $course) }}" method="POST" enctype="multipart/form-data">
        <x-elements.input label="Title" name="title" />
        <x-elements.select label="Type" name="type">
            @foreach($types as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input label="URL (optional)" placeholder="For video, task, quiz, or other" name="url" :required="false" />
        <x-elements.input label="PDF" name="pdf" type="file" :required="false" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.course_materials.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

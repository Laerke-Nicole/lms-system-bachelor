@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.show',--}}
{{--        'Courses.Course Materials',--}}
{{--        'courses.course_materials.index',--}}
{{--        'Edit',--}}
{{--        'courses.course_materials.edit',--}}
{{--        $course--}}
{{--    ) }}--}}

    <x-blocks.title title="Edit course material {{ $courseMaterial->title }}" />

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.course_materials.update', [$course, $courseMaterial]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $courseMaterial->title }}"/>
        <x-elements.select label="Type" name="type">
            @foreach($types as $type)
                <option value="{{ $type }}" {{ $courseMaterial->type === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input label="URL (optional)" placeholder="URL" name="url" :required="false" value="{{ $courseMaterial->url }}"/>
        <x-elements.input label="PDF" name="pdf" type="file" :required="false" />
        <div class="w-50 mb-3">
            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ basename($course->image) }}" class="'w-50 img-fluid">
        </div>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.course_materials.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

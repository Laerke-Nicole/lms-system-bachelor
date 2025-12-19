@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('courses.course_materials.edit', $course) }}

    <x-blocks.title title="Edit course material {{ $courseMaterial->title }}" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('courses.course_materials.update', [$course, $courseMaterial]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $courseMaterial->title }}"/>
        <x-elements.select label="Type" name="type">
            @foreach($types as $type)
                <option value="{{ $type }}" {{ $courseMaterial->type === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </x-elements.select>
        @if(!$courseMaterial->pdf)
            <x-elements.input label="URL (optional)" placeholder="URL" name="url" :required="false" value="{{ $courseMaterial->url }}"/>
        @endif
        @if(!$courseMaterial->url)
            <x-elements.input label="PDF" name="pdf" type="file" :required="false" />
        @endif
        @if($courseMaterial->pdf)
            <div class="mb-3">
                <a href="{{ asset('storage/' . $courseMaterial->pdf) }}" target="_blank">View PDF<i class="bi bi-file-earmark-pdf ms-2"></i></a>
            </div>
        @endif

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.course_materials.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

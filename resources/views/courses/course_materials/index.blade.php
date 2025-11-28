@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render('to-home', 'Course Materials', 'courses.course_materials.index') }}--}}

    <x-blocks.title href="{{ route('courses.course_materials.create', $course) }}" title="Course materials for {{ $course->title }}" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Material Type', 'Title', 'Type', 'URL', 'Actions']">
        @forelse ($courseMaterials as $courseMaterial)
            <tr>
                <td>{{ $courseMaterial->material_type }}</td>
                <td>{{ $courseMaterial->title }}</td>
                <td>{{ $courseMaterial->type }}</td>
                <td>{{ $courseMaterial->url }}</td>
                <td>
                    <x-blocks.table-actions
                                                :editRoute="route('courses.course_materials.edit', [$course, $courseMaterial])"
                                                :deleteRoute="route('courses.course_materials.destroy', [$course, $courseMaterial])"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">There are no course materials.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$courseMaterials"/>

@endsection

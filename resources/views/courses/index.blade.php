@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('courses.index') }}

    <x-blocks.title href="{{ route('courses.create') }}" title="Courses" buttonText="Create new course"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Title', 'Description', 'Duration months', 'Actions']">
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->duration_months }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('courses.show', $course->id)"
                                                :editRoute="route('courses.edit', $course->id)"
                                                :deleteRoute="route('courses.destroy', $course->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$courses"/>

@endsection

@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render('to-home', 'Requirements', 'courses.requirements.index') }}--}}

    <x-blocks.title href="{{ route('courses.requirements.create', $course) }}" title="Requirements for {{ $course->title }}" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Title', 'Content', 'Actions']">
        @foreach ($requirements as $requirement)
            <tr>
                <td>{{ $requirement->title }}</td>
                <td>{{ Str::limit($requirement->content, 80) }}</td>
                <td>
                    <x-blocks.table-actions     :showRoute="route('courses.requirements.show', [$course, $requirement])"
                                                :editRoute="route('courses.requirements.edit', [$course, $requirement])"
                                                :deleteRoute="route('courses.requirements.destroy', [$course, $requirement])"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$requirements"/>

@endsection

@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render('to-home', 'Preparations', 'courses.preparations.index') }}--}}

    <x-blocks.title href="{{ route('courses.preparations.create', $course) }}" title="Preparation material for {{ $course->title }}" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Title', 'Type', 'URL', 'Actions']">
        @foreach ($preparations as $preparation)
            <tr>
                <td>{{ $preparation->title }}</td>
                <td>{{ $preparation->type }}</td>
                <td>{{ $preparation->url }}</td>
                <td>
                    <x-blocks.table-actions
                                                :editRoute="route('courses.preparations.edit', [$course, $preparation])"
                                                :deleteRoute="route('courses.preparations.destroy', [$course, $preparation])"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$preparations"/>

@endsection

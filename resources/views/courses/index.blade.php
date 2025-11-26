@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Courses', 'courses.index') }}

    <x-blocks.title href="{{ route('courses.create') }}" title="Courses" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Title', 'Description', 'Duration', 'Actions']">
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->duration }} hrs</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('courses.show', $course->id)"
                                                :editRoute="route('courses.edit', $course->id)"
                                                :deleteRoute="route('courses.destroy', $course->id)">
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item fs-5" href="{{ route('courses.preparations.index', $course) }}">
                                <i class="bi bi-journal me-2"></i>Preparation
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item fs-5" href="{{ route('courses.requirements.index', $course) }}">
                                <i class="bi bi-clipboard-check me-2"></i>Requirement
                            </a>
                        </li>
                    </x-blocks.table-actions>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>



    <x-elements.pagination :items="$courses"/>

@endsection

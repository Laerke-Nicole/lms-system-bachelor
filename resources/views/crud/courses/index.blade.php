@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Courses', 'courses.index') }}

    <x-blocks.title href="{{ route('courses.create') }}" title="Courses" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="[
        ['label' => 'Title'],
        ['label' => 'Description', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Duration', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Max participants', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Actions'],
        ]">
        @forelse ($courses as $course)
        <tr>
            <td>{{ $course->title }}</td>
            <td class="d-none d-md-table-cell">{{ $course->description ?? '-' }}</td>
            <td class="d-none d-lg-table-cell">{{ $course->duration ? $course->duration . ' hrs' : '-' }}</td>
            <td class="d-none d-lg-table-cell">{{ $course->max_participants ?? '-' }}</td>
            <td>
                <x-blocks.table-actions :showRoute="route('courses.show', $course->id)"
                                            :editRoute="route('courses.edit', $course->id)"
                                            :deleteRoute="route('courses.destroy', $course->id)">
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item fs-5" href="{{ route('courses.requirements.index', $course) }}">
                            <i class="bi bi-clipboard-check me-2"></i>Requirement
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-5" href="{{ route('courses.course_materials.index', $course) }}">
                            <i class="bi bi-file-earmark-text me-2"></i>Course material
                        </a>
                    </li>
                </x-blocks.table-actions>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">There are no courses.</td>
        </tr>
    @endforelse
    </x-blocks.table-head>



    <x-elements.pagination :items="$courses"/>

@endsection

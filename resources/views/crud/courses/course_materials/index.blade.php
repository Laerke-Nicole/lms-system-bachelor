@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render('to-home', 'Course Materials', 'courses.course_materials.index') }}--}}

    <x-blocks.title href="{{ route('courses.course_materials.create', $course) }}" title="Course materials for {{ $course->title }}" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="[
        ['label' => 'Title'],
        ['label' => 'Type', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'View material', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Actions'],
        ]">
        @forelse ($courseMaterials as $courseMaterial)
            <tr>
                <td>{{ $courseMaterial->title }}</td>
                <td class="d-none d-md-table-cell">{{ $courseMaterial->type }}</td>
                @if($courseMaterial->url)
                    <td class="d-none d-lg-table-cell"><a href="{{ $courseMaterial->url }}" target="_blank">View material<i class="bi bi-arrow-up-right ms-2"></i></a></td>
                @elseif ($courseMaterial->pdf)
                    <td class="d-none d-lg-table-cell"><a href="{{ asset('storage/' . $courseMaterial->pdf) }}" target="_blank">View PDF<i class="bi bi-file-earmark-pdf ms-2"></i></a></td>
                @elseif (!$courseMaterial->pdf || !$courseMaterial->url)
                    <td class="d-none d-lg-table-cell">No URL or PDF linked</td>
                @endif
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

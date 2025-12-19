@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('courses.requirements', $course) }}

    <x-blocks.title href="{{ route('courses.requirements.create', $course) }}" title="Requirements for {{ $course->title }}" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="[
        ['label' => 'Title'],
        ['label' => 'Content', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Actions'],
        ]">
        @forelse ($requirements as $requirement)
            <tr>
                <td>{{ $requirement->title }}</td>
                <td class="d-none d-md-table-cell">{{ Str::limit($requirement->content, 80) }}</td>
                <td>
                    <x-blocks.table-actions     :showRoute="route('courses.requirements.show', [$course, $requirement])"
                                                :editRoute="route('courses.requirements.edit', [$course, $requirement])"
                                                :deleteRoute="route('courses.requirements.destroy', [$course, $requirement])"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">There are no requirements.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$requirements"/>

@endsection

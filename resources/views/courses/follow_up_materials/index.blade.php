@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render('to-home', 'Follow Up Materials', 'courses.follow_up_materials.index') }}--}}

    <x-blocks.title href="{{ route('courses.follow_up_materials.create', $course) }}" title="Follow up materials for {{ $course->title }}" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Title', 'Type', 'URL', 'Actions']">
        @foreach ($followUpMaterials as $followUpMaterial)
            <tr>
                <td>{{ $followUpMaterial->title }}</td>
                <td>{{ $followUpMaterial->type }}</td>
                <td>{{ $followUpMaterial->url }}</td>
                <td>
                    <x-blocks.table-actions
                                                :editRoute="route('courses.follow_up_materials.edit', [$course, $followUpMaterial])"
                                                :deleteRoute="route('courses.follow_up_materials.destroy', [$course, $followUpMaterial])"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$followUpMaterials"/>

@endsection

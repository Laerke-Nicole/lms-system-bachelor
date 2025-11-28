@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Training Slots', 'training_slots.index') }}

    <x-blocks.title href="{{ route('training_slots.create') }}" title="Training slots" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Date & time', 'Course', 'Place', 'Trainer', 'Actions']">
        @forelse ($trainingSlots as $trainingSlot)
            <tr>
                <td>{{ $trainingSlot->training_date->format('d M Y, H:i') }}</td>
                <td>{{ $trainingSlot->course->title }}</td>
                <td>{{ $trainingSlot->place }}</td>
                <td>{{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('training_slots.show', $trainingSlot->id)"
                                            :editRoute="route('training_slots.edit', $trainingSlot->id)"
                                            :deleteRoute="route('training_slots.destroy', $trainingSlot->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">There are no training slots.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$trainingSlots"/>

@endsection

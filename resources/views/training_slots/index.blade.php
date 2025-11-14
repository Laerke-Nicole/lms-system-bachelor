@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('training_slots.create') }}" title="Training slots" buttonText="Create new slot"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Date & time', 'Course', 'Place', 'Trainer', 'Actions']">
        @foreach ($trainingSlots as $trainingSlot)
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
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$trainingSlots"/>

@endsection

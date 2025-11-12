@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.create') }}" title="{{ $title ?? 'Trainings' }}" withoutButton/>

    <x-blocks.message/>

    <x-blocks.table-head
        :headers="['Date', 'Course', 'Place', 'Status', 'Trainer', 'Ordered by', 'Reminder before training', 'Reminder sent 18 months', 'Reminder sent 22 months', 'Extra comments', 'Actions']">
        @forelse ($trainings as $training)
            <tr>
                <td>{{ $training->training_date->format('d M Y H:i') }}</td>
                <td>{{ $training->course->title }}</td>
                <td>{{ $training->place }}</td>
                <td>{{ $training->status }}</td>
                <td>{{ $training->trainer->first_name }} {{ $training->trainer->last_name }}</td>
                <td>{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}</td>
                <td>{{ $training->reminder_before_training_formatted }}</td>
                <td>{{ $training->reminder_sent_18_m ? 'True' : 'False' }}</td>
                <td>{{ $training->reminder_sent_22_m ? 'True' : 'False' }}</td>
                <td>{{ $training->extra_comments }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('trainings.show', $training->id)"
                                                :editRoute="route('trainings.edit', $training->id)"
                                                :deleteRoute="route('trainings.destroy', $training->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">There are no upcoming trainings.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$trainings"/>

@endsection

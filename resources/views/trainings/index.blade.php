@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.create') }}" title="{{ $title ?? 'Trainings' }}" withoutButton/>

    <x-blocks.message/>

    <x-blocks.table-head
        :headers="['Place', 'Status', 'Date', 'Whatsapp link', 'Reminder sent 18 months', 'Reminder sent 22 months', 'Reminder before training', 'Extra comments', 'Course', 'Ordered by', 'Trainer', 'Actions']">
        @foreach ($trainings as $training)
            <tr>
                <td>{{ $training->place }}</td>
                <td>{{ $training->status }}</td>
                <td>{{ $training->training_date }} at {{ $training->training_date }} o'clock</td>
                <td>{{ $training->participation_link }}</td>
                <td>{{ $training->reminder_sent_18_m ? 'True' : 'False' }}</td>
                <td>{{ $training->reminder_sent_22_m ? 'True' : 'False' }}</td>
                <td>{{ $training->reminder_before_training }}</td>
                <td>{{ $training->extra_comments }}</td>
                <td>{{ $training->course_id }}</td>
                <td>{{ $training->ordered_by_id }}</td>
                <td>{{ $training->trainer_id }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('trainings.show', $training->id)"
                                                :editRoute="route('trainings.edit', $training->id)"
                                                :deleteRoute="route('trainings.destroy', $training->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$trainings"/>

@endsection

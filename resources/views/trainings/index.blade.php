@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.create') }}" title="Trainings" buttonText="Create new training"/>

    <x-blocks.message/>

    <x-blocks.table :headers="['Place', 'Status', 'Date', 'Time', 'Whatsapp link', 'Reminder sent 18 months', 'Reminder sent 22 months', 'Reminder before training', 'Extra comments', 'Course', 'Ordered by', 'Trainer', 'Actions']">
        @foreach ($trainings as $training)
            <tr>
                <td>{{ $training->place }}</td>
                <td>{{ $training->status }}</td>
                <td>{{ $training->training_date }}</td>
                <td>{{ $training->training_time }}</td>
                <td>{{ $training->participation_link }}</td>
                <td>{{ $training->reminder_sent_18_m ? 'True' : 'False' }}</td>
                <td>{{ $training->reminder_sent_22_m ? 'True' : 'False' }}</td>
                <td>{{ $training->reminder_before_training }}</td>
                <td>{{ $training->extra_comments }}</td>
                <td>{{ $training->course_id }}</td>
                <td>{{ $training->ordered_by_id }}</td>
                <td>{{ $training->trainer_id }}</td>
                <td>
                    <x-blocks.table-row-actions :showRoute="route('trainings.show', $training->id)"
                                                :editRoute="route('trainings.edit', $training->id)"
                                                :deleteRoute="route('trainings.destroy', $training->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table>


    <x-elements.pagination :items="$trainings"/>

@endsection

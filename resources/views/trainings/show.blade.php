@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Trainings',
        'trainings.index',
        'View',
        'trainings.show',
        $training
    ) }}

    <x-blocks.title title="Training for: {{ $training->course->title }}"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Date" title="{{ $training->training_slot->training_date->format('d M Y H:i') }}"></x-blocks.detail>
        <x-blocks.detail field="Course" title="{{ $training->training_slot->course->title }}"></x-blocks.detail>
        <x-blocks.detail field="Place" title="{{ $training->training_slot->place }}"></x-blocks.detail>
        <x-blocks.detail field="Trainer" title="{{ $training->training_slot->trainer->first_name. ' ' . ($training->trainer)->last_name }}"></x-blocks.detail>
        <x-blocks.detail field="Ordered by" title="{{ $training->orderedBy->first_name. ' ' . ($training->orderedBy)->last_name }}"></x-blocks.detail>
        <x-blocks.detail field="Whatsapp link" title="{{ $training->participation_link }}"></x-blocks.detail>
        @if($training->status === 'Upcoming')
            <x-blocks.detail field="Reminder before training" title="{{ $training->reminder_before_training_formatted }}"></x-blocks.detail>
        @endif
        @if(in_array($training->status, ['Completed', 'Expired']))
            <x-blocks.detail field="Reminder sent 18 months" title="{{ $training->reminder_sent_18_m ? 'Yes' : 'No' }}"></x-blocks.detail>
            <x-blocks.detail field="Reminder sent 22 months" title="{{ $training->reminder_sent_22_m ? 'Yes' : 'No' }}"></x-blocks.detail>
        @endif
        <x-blocks.detail field="Status" title="{{ $training->status }}"></x-blocks.detail>
    </div>

@endsection

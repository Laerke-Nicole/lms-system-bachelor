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

    <x-blocks.title title="Training for {{ $training->trainingSlot->course->title }}" />

    <div class="row">
        <x-blocks.detail field="Date" title="{{ $training->trainingSlot->training_date->format('d M Y H:i') }}" />
        <x-blocks.detail field="Course" title="{{ $training->trainingSlot->course->title }}" />
        <x-blocks.detail field="Place" title="{{ $training->trainingSlot->place }}" />
        <x-blocks.detail field="Trainer" title="{{ $training->trainingSlot->trainer->first_name}} {{$training->trainingSlot->trainer->last_name }}" />
        <x-blocks.detail field="Ordered by" title="{{ $training->orderedBy->first_name. ' ' . ($training->orderedBy)->last_name }}" />

        <p class="text-dark mb-1 fs-4">Participants</p>
        @foreach($training->users as $user)
            <x-blocks.detail title="{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}" col="col-md-6"/>
            <div class="col-md-6">
                <input type="hidden" name="leader_can_view_info" value="0">

                <x-elements.input label="Allow your leader to view your information? (Needed for them to book you)" name="leader_can_view_info" type="checkbox" value="1" class="form-check-input" col="col-5" :required="false" :checked="(bool) $user->leader_can_view_info" />
            </div>
        @endforeach

        <x-blocks.detail field="Whatsapp link" title="{{ $training->trainingSlot->participation_link }}" />
        @if($training->status === 'Upcoming')
            <x-blocks.detail field="Reminder before training" title="{{ $training->reminder_before_training ?? 'No' }}" />
        @endif
        @if(in_array($training->status, ['Completed', 'Expired']))
            <x-blocks.detail field="Reminder sent 18 months" title="{{ $training->reminder_sent_18_m ? 'Yes' : 'No' }}" />
            <x-blocks.detail field="Reminder sent 22 months" title="{{ $training->reminder_sent_22_m ? 'Yes' : 'No' }}" />
        @endif
        <x-blocks.detail field="Status" title="{{ $training->status }}" />
    </div>

@endsection

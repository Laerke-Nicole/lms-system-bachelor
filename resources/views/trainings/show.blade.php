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

    @if($training->trainingSlot && $training->trainingSlot->course)
        <x-blocks.title title="Training for {{ $training->trainingSlot->course->title }}" />
    @else
        <x-blocks.title title="Training Details" />
    @endif

    <div class="row section-spacing">
        @if($training->trainingSlot && $training->trainingSlot->training_date)
            <x-blocks.detail field="Date" title="{{ $training->trainingSlot->training_date->format('d M Y H:i') }}" />
        @endif
        @if($training->trainingSlot && $training->trainingSlot->course)
            <x-blocks.detail field="Course" title="{{ $training->trainingSlot->course->title }}" />
        @endif
        @if($training->trainingSlot && $training->trainingSlot->place)
            <x-blocks.detail field="Place" title="{{ $training->trainingSlot->place }}" />
        @endif
        @if($training->trainingSlot && $training->trainingSlot->trainer)
            <x-blocks.detail field="Trainer" title="{{ $training->trainingSlot->trainer->first_name}} {{$training->trainingSlot->trainer->last_name }}" />
        @endif
        @if($training->orderedBy)
            <x-blocks.detail field="Ordered by" title="{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}" secondTitle="{{ $training->orderedBy->email }}" />
        @endif
        @if($training->trainingSlot && $training->trainingSlot->participation_link)
            <x-blocks.detail field="Link to call" title="{{ $training->trainingSlot->participation_link }}" :isUrl="true" target="_blank" />
        @endif
        @if($training->status === 'Upcoming')
            <x-blocks.detail field="Reminder before training" title="{{ $training->reminder_before_training ?? 'No' }}" />
        @endif
        @if(in_array($training->status, ['Completed', 'Expired']))
            <x-blocks.detail field="Reminder sent 18 months" title="{{ $training->reminder_sent_18_m ? 'Yes' : 'No' }}" />
            <x-blocks.detail field="Reminder sent 22 months" title="{{ $training->reminder_sent_22_m ? 'Yes' : 'No' }}" />
        @endif
        @if($training->status)
            <x-blocks.detail field="Status" title="{{ $training->status }}" />
        @endif

{{--        show the certificate of this training --}}
        @if($training->certificate)
            <x-blocks.download-certificate :training="$training" />
        @endif

{{--        table with users where you can say if the user has completed the test, evaluation or signed --}}
        <livewire:training-participants-completion :training="$training" />

    </div>

@endsection

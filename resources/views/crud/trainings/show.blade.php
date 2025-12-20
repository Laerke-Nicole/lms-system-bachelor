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
        @if($training->orderedBy && auth()->user()->role === 'admin')
            <x-blocks.detail field="Ordered by" title="{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}" secondTitle="{{ $training->orderedBy->email }}" />
        @endif
        @if($training->trainingSlot && $training->trainingSlot->participation_link)
            <x-blocks.detail field="Link to call" title="{{ $training->trainingSlot->participation_link }}" :isUrl="true" target="_blank" />
        @endif
        @if($training->status === 'Upcoming' && auth()->user()->role === 'admin')
            <x-blocks.detail field="Reminder before training" title="{{ $training->reminder_before_training ?? 'Not sent' }}" />
        @endif
        @if(in_array($training->status, ['Completed', 'Expiring']) && auth()->user()->role === 'admin')
            <x-blocks.detail field="Reminder sent 18 months" title="{{ $training->reminder_sent_18_m ? 'Reminder sent' : 'Not sent' }}" />
            <x-blocks.detail field="Reminder sent 22 months" title="{{ $training->reminder_sent_22_m ? 'Reminder sent' : 'Not sent' }}" />
        @endif
        @if($training->status)
            <x-blocks.detail field="Status" title="{{ $training->status }}" />
        @endif

{{--        show the users own certificate of this training --}}
        @if(auth()->user()->role === 'user' && $userTrainingRecord && in_array($training->status, ['Completed', 'Expiring']))
            @include('components.blocks.trainings-certificate-auth-download')
        @endif
{{--        show the users own assessment of this training --}}
        @if(auth()->user()->role === 'user' && $userTrainingRecord && in_array($training->status, ['Completed', 'Expiring']))
            @include('components.blocks.trainings-assessment-auth-download')
        @endif

{{--        table with users where you can say if the user has completed the test, evaluation or signed --}}
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'leader')
            <livewire:training-participants-completion :training="$training" />
        @endif

    </div>

@endsection

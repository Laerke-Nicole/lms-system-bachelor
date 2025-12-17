@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Training Slots',
        'training_slots.index',
        'Edit',
        'training_slots.edit',
        $trainingSlot
    ) }}


    @if($trainingSlot->course)
        <x-blocks.title title="Training slot for: {{ $trainingSlot->course->title }}" />
    @else
        <x-blocks.title title="Training Slot Details" />
    @endif

    <div class="row">
        @if($trainingSlot->training_date)
            <x-blocks.detail field="Date & time" title="{{ $trainingSlot->training_date->format('d M Y H:i') }}" />
        @endif
        @if($trainingSlot->course)
            <x-blocks.detail field="Course" title="{{ $trainingSlot->course->title }}" />
        @endif
        @if($trainingSlot->place)
            <x-blocks.detail field="Place" title="{{ $trainingSlot->place }}" />
        @endif
        @if($trainingSlot->status)
            <x-blocks.detail field="Status" title="{{ $trainingSlot->status }}" />
        @endif
        @if($trainingSlot->trainer)
            <x-blocks.detail field="Trainer" title="{{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}" />
        @endif
        @if($trainingSlot->createdByAdmin)
            <x-blocks.detail field="Created by" title="{{ $trainingSlot->createdByAdmin->first_name }} {{ $trainingSlot->createdByAdmin->last_name }}" />
        @endif
        @if($trainingSlot->participation_link)
            <x-blocks.detail field="Participation link" title="{{ $trainingSlot->participation_link }}" />
        @endif
    </div>

@endsection

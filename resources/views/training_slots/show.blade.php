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


    <x-blocks.title title="Training slot for: {{ $trainingSlot->course->title }}" />

    <div class="row">
        <x-blocks.detail field="Date & time" title="{{ $trainingSlot->training_date->format('d M Y H:i') }}" />
        <x-blocks.detail field="Course" title="{{ $trainingSlot->course->title }}" />
        <x-blocks.detail field="Place" title="{{ $trainingSlot->place }}" />
        <x-blocks.detail field="Status" title="{{ $trainingSlot->status }}" />
        <x-blocks.detail field="Trainer" title="{{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}" />
        <x-blocks.detail field="Created by" title="{{ $trainingSlot->createdByAdmin->first_name }} {{ $trainingSlot->createdByAdmin->last_name }}" />
        <x-blocks.detail field="Participation link" title="{{ $trainingSlot->participation_link }}" />
    </div>

@endsection

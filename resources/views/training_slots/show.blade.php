@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('training_slots.index') }}" title="Training slot for: {{ $trainingSlot->course->title }}"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Date & time" title="{{ $trainingSlot->training_date->format('d M Y H:i') }}"></x-blocks.detail>
        <x-blocks.detail field="Course" title="{{ $trainingSlot->course->title }}"></x-blocks.detail>
        <x-blocks.detail field="Place" title="{{ $trainingSlot->place }}"></x-blocks.detail>
        <x-blocks.detail field="Status" title="{{ $trainingSlot->status }}"></x-blocks.detail>
        <x-blocks.detail field="Trainer" title="{{ $trainingSlot->trainer->first_name. ' ' . $trainingSlot->trainer->last_name }}"></x-blocks.detail>
        <x-blocks.detail field="Created by" title="{{ $trainingSlot->createdByAdmin->first_name. ' ' . $trainingSlot->createdByAdmin->last_name }}"></x-blocks.detail>
        <x-blocks.detail field="Participation link" title="{{ $trainingSlot->participation_link }}"></x-blocks.detail>
    </div>

@endsection

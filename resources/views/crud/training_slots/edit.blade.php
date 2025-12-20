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


    <x-blocks.title title="Edit training slot for: {{ $trainingSlot->course->title }}" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('training_slots.update', $trainingSlot->id) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Date & time" name="training_date" type="datetime-local" value="{{ $trainingSlot->training_date->format('Y-m-d\TH:i') }}" />

        <x-elements.select label="Place" name="place">
            @foreach($places as $place)
                <option value="{{ $place }}" {{ $trainingSlot->place === $place ? 'selected' : '' }}>{{ $place }}</option>
            @endforeach
        </x-elements.select>

        <x-elements.select label="Trainer" name="trainer_id">
            @foreach($trainers as $trainer)
                <option value="{{ $trainer->id }}" {{ $trainingSlot->trainer_id === $trainer->id ? 'selected' : '' }}>{{ $trainer->first_name }} {{ $trainer->last_name }}</option>
            @endforeach
        </x-elements.select>

        <x-elements.input label="Participation link (optional)" placeholder="Participation link" name="participation_link" type="url" value="{{ $trainingSlot->participation_link }}" :required="false" maxlength="2048" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('training_slots.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

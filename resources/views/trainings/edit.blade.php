@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.index') }}" title="Edit training for: {{ $training->course->title }}"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('trainings.update', $training->id) }}" method="post">
        @method('PUT')

        <x-elements.select label="Place" name="place" col="col-12 col-lg-4">
            @foreach($places as $place)
                <option value="{{ $place }}" {{ $training->place === $place ? 'selected' : '' }}>{{ $place }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input col="col-12 col-lg-4" label="Date" name="training_date" type="date" value="{{ $training->training_date }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Time" name="training_time" type="time" value="{{ $training->training_time }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Whatsapp link" name="participation_link" value="{{ $training->participation_link }}"/>
        <x-elements.textarea col="col-12 col-lg-4" label="Extra comments" name="extra_comments" value="{{ $training->extra_comments }}" />
        <x-elements.select label="Trainer" name="trainer_id" col="col-12 col-lg-4">
            @foreach($trainers as $trainer)
                <option value="{{ $trainer->id }}" {{ $training->trainer_id === $trainer->id ? 'selected' : '' }}>{{ $trainer->first_name }} {{ $trainer->last_name }}</option>
            @endforeach
        </x-elements.select>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('trainings.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

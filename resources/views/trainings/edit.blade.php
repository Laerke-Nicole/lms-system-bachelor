@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.index') }}" title="Edit training"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('trainings.update', $training->id) }}" method="post">
        @method('PUT')

        <x-elements.select label="Place" name="place">
            @foreach($trainings as $training)
                <option value="{{ $training->id }}">{{ $training->place }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.select label="Status" name="status">
            @foreach($trainings as $training)
                <option value="{{ $training->id }}">{{ $training->status }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input col="col-12 col-lg-4" label="Date" name="training_date" type="date" value="{{ $training->training_date }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Time" name="training_time" type="time" value="{{ $training->training_time }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Whatsapp link" name="participation_link" value="{{ $training->participation_link }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Reminder sent 18 months" name="reminder_sent_18_m" type="checkbox" value="{{ $training->reminder_sent_18_m }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Reminder sent 22 months" name="reminder_sent_22_m" type="checkbox" value="{{ $training->reminder_sent_22_m }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Reminder before training" name="reminder_before_training" type="date" value="{{ $training->reminder_before_training }}"/>
        <x-elements.textarea col="col-12 col-lg-4" label="Extra comments" name="extra_comments" value="{{ $training->extra_comments }}" />
        <x-elements.input col="col-12 col-lg-4" label="Course" name="course_id" value="{{ $training->course_id }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Ordered by" name="ordered_by_id" value="{{ $training->ordered_by_id }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Trainer" name="trainer_id" value="{{ $training->trainer_id }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('trainings.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

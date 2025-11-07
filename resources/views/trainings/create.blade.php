@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.index') }}" title="Add new training"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('trainings.store') }}" method="POST">
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
        <x-elements.input col="col-12 col-lg-4" label="Date" name="training_date" type="date" />
        <x-elements.input col="col-12 col-lg-4" label="Time" name="training_time" type="time" />
        <x-elements.input col="col-12 col-lg-4" label="Whatsapp link" name="participation_link" />
        <x-elements.input col="col-12 col-lg-4" label="Reminder sent 18 months" name="reminder_sent_18_m" type="checkbox" class="form-check-input" />
        <x-elements.input col="col-12 col-lg-4" label="Reminder sent 22 months" name="reminder_sent_22_m" type="checkbox" class="form-check-input" />
        <x-elements.input col="col-12 col-lg-4" label="Reminder before training" name="reminder_before_training" type="date" />
        <x-elements.textarea col="col-12 col-lg-4" label="Extra comments" name="extra_comments" />
        <x-elements.input col="col-12 col-lg-4" label="Course" name="course_id" />
        <x-elements.input col="col-12 col-lg-4" label="Ordered by" name="ordered_by_id" />
        <x-elements.input col="col-12 col-lg-4" label="Trainer" name="trainer_id" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

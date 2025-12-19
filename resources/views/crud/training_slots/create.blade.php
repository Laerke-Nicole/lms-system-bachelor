@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.create',
        'Training Slots',
        'training_slots.index',
        'Create',
        'training_slots.create'
    ) }}

    <x-blocks.title title="Create new training slot" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('training_slots.store') }}" method="POST">

        <x-elements.input label="Date & time" name="training_date" type="datetime-local" />

        <x-elements.select label="Course" name="course_id">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}</option>
            @endforeach
        </x-elements.select>

        <x-elements.select label="Place" name="place">
            @foreach($places as $place)
                <option value="{{ $place }}">{{ $place }}</option>
            @endforeach
        </x-elements.select>

        <x-elements.select label="Trainer" name="trainer_id">
            @foreach($trainers as $trainer)
                <option value="{{ $trainer->id }}">{{ $trainer->first_name }} {{ $trainer->last_name }}</option>
            @endforeach
        </x-elements.select>

        <x-elements.input label="Participation link (optional)" placeholder="Participation link" name="participation_link" type="url" :required="false" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('training_slots.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

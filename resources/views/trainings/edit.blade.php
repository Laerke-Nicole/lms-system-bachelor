@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Trainings',
        'trainings.index',
        'Edit',
        'trainings.edit',
        $training
    ) }}

    <x-blocks.title title="Edit training for: {{ $training->trainingSlot->course->title }}"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('trainings.update', $training->id) }}" method="POST">
        @method('PUT')

{{--        <x-elements.input label="Date" name="training_date" type="datetime-local" value="{{ $training->training_date }}" />--}}

{{--        <x-elements.select label="Course" name="course">--}}
{{--            @foreach($courses as $course)--}}
{{--                <option value="{{ $course->id }}" {{ $training->course === $course ? 'selected' : '' }}>{{ $course->title }}</option>--}}
{{--            @endforeach--}}
{{--        </x-elements.select>--}}

{{--        <x-elements.select label="Place" name="place">--}}
{{--            @foreach($places as $place)--}}
{{--                <option value="{{ $place }}" {{ $training->place === $place ? 'selected' : '' }}>{{ $place }}</option>--}}
{{--            @endforeach--}}
{{--        </x-elements.select>--}}

{{--        <x-elements.select label="Trainer" name="trainer">--}}
{{--            @foreach($trainers as $trainer)--}}
{{--                <option value="{{ $trainer->id }}">{{ $trainer->first_name }} {{ $trainer->last_name }}</option>--}}
{{--            @endforeach--}}
{{--        </x-elements.select>--}}

{{--        <x-elements.input label="Whatsapp link (optional, can be added later)" placeholder="Whatsapp link" name="participation_link" type="url" value="{{ $training->participation_link }}" />--}}

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('trainings.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

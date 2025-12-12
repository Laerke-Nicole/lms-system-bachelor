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

    <x-blocks.title title="Edit training for: {{ $training->trainingSlot->course->title }}" />

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('trainings.update', $training->id) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Date" name="training_date" type="datetime-local" value="{{ $training->trainingSlot->training_date }}" />

        @if(auth()->user()->role === 'admin')
            <x-elements.select label="Place" name="place">
                @foreach($places as $place)
                    <option value="{{ $place }}" {{ $training->trainingSlot->place === $place ? 'selected' : '' }}>{{ $place }}</option>
                @endforeach
            </x-elements.select>
        @endif

        @if(auth()->user()->role === 'admin')
            <x-elements.input label="Whatsapp link (optional, can be added later)" placeholder="Whatsapp link" name="participation_link" type="url" value="{{ $training->trainingSlot->participation_link }}" />
        @endif

        @if(auth()->user()->role === 'admin')
            <x-elements.select label="Status" name="status">
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $training->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </x-elements.select>
        @endif

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('trainings.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

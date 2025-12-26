@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Training Slots', 'training_slots.index') }}

    <x-blocks.title href="{{ route('training_slots.create') }}" title="Training slots" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="[
        ['label' => 'Date & time'],
        ['label' => 'Course', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Place', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Trainer', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Actions'],
        ]">
        @forelse ($trainingSlots as $trainingSlot)
            <tr>
                <td>{{ $trainingSlot->training_date ? $trainingSlot->training_date->format('d M Y, H:i') : '-' }}</td>
                <td class="d-none d-md-table-cell">{{ $trainingSlot->course->title ?? '-' }}</td>
                <td class="d-none d-lg-table-cell">{{ $trainingSlot->place ?? '-' }}</td>
                <td class="d-none d-lg-table-cell">
                    @if($trainingSlot->trainer)
                        {{ $trainingSlot->trainer->first_name }} {{ $trainingSlot->trainer->last_name }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <x-blocks.table-actions :showRoute="route('training_slots.show', $trainingSlot->id)"
                                            :editRoute="route('training_slots.edit', $trainingSlot->id)"
                                            :deleteRoute="route('training_slots.destroy', $trainingSlot->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">There are no training slots.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$trainingSlots"/>

@endsection

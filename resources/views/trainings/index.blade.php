@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.create') }}" title="{{ $title ?? 'Trainings' }}" buttonText="Create new training"/>

    <x-blocks.message/>

    <livewire:trainings-table />

@endsection

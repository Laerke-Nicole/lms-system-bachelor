@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.create') }}" title="{{ $title ?? 'Trainings' }}" withoutButton/>

    <x-blocks.message/>

    <livewire:trainings-table />

@endsection

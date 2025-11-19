@extends('layouts.app')

@section('content')

    <x-blocks.title title="{{ $title ?? 'Trainings' }}" withoutButton />

    <x-blocks.message/>

    <livewire:trainings-table />

@endsection

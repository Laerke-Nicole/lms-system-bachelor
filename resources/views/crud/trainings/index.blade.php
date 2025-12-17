@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Trainings', 'trainings.index') }}

    <x-blocks.title title="{{ $title ?? 'Trainings' }}" withoutButton />

    <x-blocks.message/>

    <livewire:trainings-table />

@endsection

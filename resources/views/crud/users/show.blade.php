@extends('layouts.app')

@section('content')

    @if(auth()->user()->role === 'admin')
        {{ Breadcrumbs::render(
        'crud.show',
        'Participants',
        'users.index',
        'View',
        'users.show',
        $user
    ) }}
    @elseif(auth()->user()->role === 'leader')
        {{ Breadcrumbs::render(
        'crud.show',
        'Employees',
        'users.index',
        'View',
        'users.show',
        $user
    ) }}
    @endif

    <x-blocks.title title="{{ $user->first_name }} {{ $user->last_name }}" />

    <div class="row">
        <x-blocks.detail field="Email" title="{{ $user->email }}" />
        <x-blocks.detail field="Phone" title="{{ $user->phone }}" />
    </div>

@endsection

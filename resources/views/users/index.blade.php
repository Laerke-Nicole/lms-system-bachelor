@extends('layouts.app')

@section('content')

    @if(auth()->user()->role === 'admin')
        {{ Breadcrumbs::render('to-home', 'Participants', 'users.index') }}
        <x-blocks.title title="Participants" />
    @elseif(auth()->user()->role === 'leader')
        {{ Breadcrumbs::render('to-home', 'Employees', 'users.index') }}
        <x-blocks.title title="Employees" buttonText="Register employees" />
    @endif

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Full name', 'Email', 'Phone', 'Actions']">
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('users.show', $user->id)"
                                            :deleteRoute="route('users.destroy', $user->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                @if(auth()->user()->role === 'admin')
                    <td colspan="3">There are no participants.</td>
                @elseif(auth()->user()->role === 'leader')
                    <td colspan="3">There are no employees.</td>
                @endif
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$users"/>

@endsection

@extends('layouts.app')

@section('content')

    @if(auth()->user()->role === 'admin')
        {{ Breadcrumbs::render('to-home', 'Participants', 'users.index') }}
        <x-blocks.title title="Participants" buttonText="Register a leader" href="{{ route('register') }}" />
    @elseif(auth()->user()->role === 'leader')
        {{ Breadcrumbs::render('to-home', 'Employees', 'users.index') }}
        <x-blocks.title title="Employees" buttonText="Register employees" href="{{ route('register') }}" />
    @endif

    <x-blocks.message/>

    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col" class="text-label-1 text-body">Full name</th>
            <th scope="col" class="text-label-1 text-body d-none d-md-table-cell">Email</th>
            <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Phone</th>
            @if(auth()->user()->role === 'admin')
                <th scope="col" class="text-label-1 text-body d-none d-lg-table-cell">Company</th>
            @endif
            <th scope="col" class="text-label-1 text-body">Actions</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                    <td class="d-none d-lg-table-cell">{{ $user->phone }}</td>
                    @if(auth()->user()->role === 'admin')
                        @if($user->site->company->company_name)
                            <td class="d-none d-lg-table-cell">{{ $user->site->company->company_name }}
                                @if($user->site->site_name)
                                    <br><span class="text-muted">{{ $user->site->site_name }}</span>
                                @endif
                            </td>
                        @endif
                    @endif
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
        </tbody>
    </table>

    <x-elements.pagination :items="$users"/>

@endsection

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
        @if($user->email)
            <x-blocks.detail field="Email" title="{{ $user->email }}" />
        @endif
        @if($user->phone)
            <x-blocks.detail field="Phone" title="{{ $user->phone }}" />
        @endif
        @if(auth()->user()->role === 'admin')
            @if($user->site->company->company_name)
                <x-blocks.detail field="Company" title="{{ $user->site->company->company_name }}" />
            @endif
            @if($user->site->site_name)
                <x-blocks.detail field="Site" title="{{ $user->site->site_name }}" />
            @endif
        @endif
    </div>

@endsection

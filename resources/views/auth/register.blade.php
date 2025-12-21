@extends('layouts.app')

@section('content')

    @if(auth()->user()->role === 'admin')
        {{ Breadcrumbs::render(
            'crud.create',
            'Leader',
            'users.index',
            'Register',
            'users.create'
        ) }}
        <x-blocks.title title="Register a leader" subTitle="Note: If you leave the password field empty, a random password will be generated" />
    @elseif(auth()->user()->role === 'leader')
        {{ Breadcrumbs::render(
            'crud.create',
            'Employee',
            'users.index',
            'Register',
            'users.create'
        ) }}
        <x-blocks.title title="Register an employee" subTitle="Note: If you leave the password field empty, a random password will be generated" />
    @endif

    <x-blocks.message />

    <x-blocks.form action="{{ route('register') }}" method="POST">
        <x-elements.input label="First name" placeholder="Enter your first name" name="first_name" type="text" :value="old('first_name')" maxlength="100" />
        <x-elements.input label="Last name" placeholder="Enter your last name" name="last_name" type="text" :value="old('last_name')" maxlength="100" />
        <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" :value="old('email')" maxlength="254" />
        <x-elements.input label="Phone" placeholder="Enter your phone number" name="phone" type="text" :value="old('phone')" maxlength="20" />
        @if(auth()->user()->role === 'admin')
            <x-elements.select label="Site" name="site_id">
                @foreach($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->site_name }} ({{ $site->company->company_name }})</option>
                @endforeach
            </x-elements.select>
        @endif

        <x-elements.input label="Password" placeholder="Enter your password" name="password" type="password" :required="false" />
        <x-elements.input labelFor="password_confirmation" label="Confirm password" placeholder="Confirm your password" name="password_confirmation" type="password" :required="false" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
        @if(auth()->user()->role === 'leader')
            <input type="hidden" name="site_id" value="{{ auth()->user()->site_id }}">
        @endif
    </x-blocks.form>

@endsection

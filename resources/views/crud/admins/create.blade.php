@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.create',
        'Admins',
        'admins.index',
        'Create',
        'admins.create'
    ) }}

    <x-blocks.title title="Create new admin" subTitle="Note: If you leave the password field empty, a random password will be generated" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('admins.store') }}" method="POST">
        <x-elements.input label="First name" placeholder="Enter first name" name="first_name" type="text" :value="old('first_name')" maxlength="100" />
        <x-elements.input label="Last name" placeholder="Enter last name" name="last_name" type="text" :value="old('last_name')" maxlength="100" />
        <x-elements.input label="Email" placeholder="Enter email" name="email" type="email" :value="old('email')" maxlength="254" />
        <x-elements.input label="Phone" placeholder="Enter phone number" name="phone" type="text" :value="old('phone')" maxlength="20" />

        <x-elements.input label="Password" placeholder="Enter password" name="password" type="password" :required="false" />
        <x-elements.input labelFor="password_confirmation" label="Confirm password" placeholder="Confirm password" name="password_confirmation" type="password" :required="false" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

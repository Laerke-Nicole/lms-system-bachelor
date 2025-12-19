@extends('layouts.profile')

@section('profile-content')

    <h3>Change Password</h3>
    <p class="mb-4">Update your password for your account.</p>

    <x-blocks.form action="{{ route('profiles.password.update') }}" method="POST">
        @method('PUT')

        <x-elements.input label="Current password" name="current_password" type="password" col="col-12" />

        <x-elements.input label="New password" name="password" type="password" col="col-12" />

        <x-elements.input label="Confirm new password" name="password_confirmation" type="password" col="col-12" />

        <div class="d-flex flex-wrap align-items-baseline gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Save password</button>
        </div>

        <x-blocks.message />

    </x-blocks.form>

@endsection

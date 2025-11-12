@extends('layouts.layout')

@section('content')
    <div class="vh-100 container">
        <div class="row">
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-center">
                <h3>Reset your password</h3>
                <p class="mb-4 fs-5">Choose a new password for your account.</p>

                <x-blocks.form action="{{ route('password.update') }}" method="POST" class="mb-0">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" :value="old('email')" class="mb-4 form-control box-shadow-inset" />
                    <x-elements.input label="Password" placeholder="Enter your password" name="password" type="password" />
                    <x-elements.input labelFor="password_confirmation" label="Confirm password" placeholder="Confirm your password" name="password_confirmation" type="password" />

                    <div class="d-flex flex-column mt-2">
                        <button type="submit" class="btn btn-primary mb-0">Reset password</button>
                    </div>

                    <x-blocks.message />
                    <x-blocks.error-alert />
                </x-blocks.form>
            </div>
        </div>
    </div>
@endsection

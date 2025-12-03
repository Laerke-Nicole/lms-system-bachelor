@extends('layouts.layout')

@section('content')
    <div class="vh-100 container-fluid auth">
        <div class="row h-100">
            <!-- left side with form -->
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start auth-left">
                <div class="p-4 d-flex flex-column w-100 auth-left__container">
                    <div class="w-100">
                        <h3>Reset your password</h3>
                        <p class="mb-4 fs-5">Choose a new password for your account.</p>

                        <x-blocks.form action="{{ route('password.update') }}" method="POST" class="mb-0">
                            <input type="hidden" name="token" value="{{ $token }}">

                            <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" :value="old('email')" class="mb-4 form-control box-shadow-inset" col="col-12" />
                            <x-elements.input label="Password" placeholder="Enter your password" name="password" type="password" col="col-12" />
                            <x-elements.input labelFor="password_confirmation" label="Confirm password" placeholder="Confirm your password" name="password_confirmation" type="password" col="col-12" />

                            <div class="d-flex flex-column mt-2">
                                <button type="submit" class="btn btn-primary">Reset password</button>
                            </div>

                            <x-blocks.message />
                            <x-blocks.error-alert />
                        </x-blocks.form>
                    </div>
                </div>
            </div>

            <!-- right side with img -->
            <div class="col-lg-8 p-0 d-none d-lg-block">
                <img src="https://cdn.pixabay.com/photo/2015/06/23/08/16/daegwallyeong-818420_1280.jpg" alt="" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
        </div>
    </div>
@endsection

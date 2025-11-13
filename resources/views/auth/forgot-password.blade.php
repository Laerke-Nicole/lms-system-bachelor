@extends('layouts.layout')

@section('content')
    <div class="vh-100 container-fluid auth">
        <div class="row h-100">
            <!-- left side with form -->
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start auth-left">
                <div class="p-4 d-flex flex-column w-100 auth-left__container">
                    <div class="w-100">
                        <h3>Did you forget your password?</h3>
                        <p class="mb-4 fs-5">We will send you an email so you can reset your password.</p>

                        <x-blocks.form action="{{ route('password.email') }}" method="POST" class="mb-0">
                            <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" :value="old('email')" class="mb-4 form-control box-shadow-inset" />

                            <div class="d-flex flex-column mt-2">
                                <button type="submit" class="btn btn-primary mb-0">Get reset email</button>
                            </div>

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

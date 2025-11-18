@extends('layouts.layout')

@section('content')
    <div class="vh-100 container-fluid auth">
        <div class="row h-100">
            <!-- left side with form -->
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start auth-left">
                <div class="p-4 d-flex flex-column w-100 auth-left__container">
                    <div class="mb-5">
                        <img src="{{ asset('storage/' . $abInventech->logo) }}" alt="{{ basename($abInventech->logo) }}" class="w-25 img-fluid">
                    </div>

                    <div class="w-100">
                        <h3 class="mb-4">Log in</h3>

                        <x-blocks.form action="{{ route('login') }}" method="POST" class="mb-0">
                            <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" :value="old('email')" col="col-12" />

                            <x-elements.input label="Password" placeholder="Enter your password" name="password" type="password" col="col-12" />

                            <div class="d-flex flex-column mt-2">
                                <a href="{{ route('password.request') }}" class="small mb-4 text-decoration-none text-secondary opacity-75 fs-5"><u>Forgot your password?</u></a>
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>

                            <x-blocks.error-alert />
                        </x-blocks.form>
                    </div>
                </div>
            </div>

            <!-- right side with img -->
            <div class="col-lg-8 p-0 d-none d-lg-block">
{{--                <img src="{{ asset('images/login-bg.jpg') }}"--}}
{{--                     alt="Wind turbines"--}}
{{--                     class="img-fluid w-100 h-100 object-fit-cover">--}}
                <img src="https://cdn.pixabay.com/photo/2015/06/23/08/16/daegwallyeong-818420_1280.jpg" alt="" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
        </div>
    </div>
@endsection

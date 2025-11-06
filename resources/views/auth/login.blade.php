@extends('layouts.layout')

@section('content')
    <div class="vh-100">
        <div class="row h-100">
            <!-- left side with form -->
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start">
                <div class="px-0 px-lg-5">
                    <div class="mb-5">
                        <img src="{{ asset('images/default-logo.png') }}" alt="Logo" class="logo">
                    </div>

                    <div class="w-100" style="max-width: 320px;">
                        <h3 class="mb-4">Log in</h3>

                        <x-blocks.form action="{{ route('login') }}" method="POST">
                            <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" required :value="old('email')" />

                            <x-elements.input label="Password" placeholder="Enter your password" name="password" type="password" required />

                            <div class="d-flex flex-column mt-2">
                                <a href="#" class="small mb-4 text-decoration-none text-secondary opacity-75 fs-5"><u>Forgot your password?</u></a>
                                <button type="submit" class="btn btn-primary">Log in</button>
                            </div>

                            <x-blocks.error-alert />
                        </x-blocks.form>
                    </div>
                </div>
            </div>

            <!-- right side with img -->
            <div class="col-lg-8 d-none d-lg-block p-0">
{{--                <img src="{{ asset('images/login-bg.jpg') }}"--}}
{{--                     alt="Wind turbines"--}}
{{--                     class="img-fluid w-100 h-100 object-fit-cover">--}}
                <img src="https://cdn.pixabay.com/photo/2015/06/23/08/16/daegwallyeong-818420_1280.jpg" alt="" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
        </div>
    </div>
@endsection

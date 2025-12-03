@extends('layouts.layout')

@section('content')
    <div class="vh-100 container-fluid">
        <div class="row h-100">
            <!-- left side with form -->
            <div class="col-12 col-md-6 col-lg-4 d-flex flex-column justify-content-between align-items-start">

                <div class="p-md-4 d-flex flex-column w-100">
                    <div>
                        <div class="mb-5">
                            <img src="{{ asset('storage/' . $abInventech->logo) }}" alt="{{ basename($abInventech->logo) }}" class="w-36 img-fluid">
                        </div>

                        <div class="w-100">
                            <h3 class="mb-4">Log in</h3>

                            <x-blocks.form action="{{ route('login') }}" method="POST" class="mb-0">
                                <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" :value="old('email')" col="col-12" />
                                <x-elements.input label="Password" placeholder="Enter your password" name="password" type="password" col="col-12" />

                                <x-blocks.error-alert />

                                <div class="d-flex flex-column mt-2">
                                    <a href="{{ route('password.request') }}" class="small mb-4 text-decoration-none opacity-75 fs-5"><u>Forgot your password?</u></a>
                                    <button type="submit" class="btn btn-primary">Log in</button>
                                </div>
                            </x-blocks.form>
                        </div>
                    </div>
                </div>

                <!-- privacy policy link -->
                <div class="pb-3 ms-md-4">
                    <a href="{{ route('gdprs.privacy-policy') }}" class="fs-6 text-decoration-none opacity-75"><u>Privacy policy</u></a>
                </div>
            </div>

            <!-- right side with img -->
            <div class="col-md-6 col-lg-8 p-0 d-none d-md-block">
                <img src="https://cdn.pixabay.com/photo/2015/06/23/08/16/daegwallyeong-818420_1280.jpg" alt="windmill" class="img-fluid w-100 h-100 object-fit-cover">
            </div>
        </div>
    </div>
@endsection

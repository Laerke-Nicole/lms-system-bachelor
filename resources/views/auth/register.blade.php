@extends('layouts.layout')

@section('content')
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- left side with form -->
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center align-items-start px-0 px-lg-5 bg-white">
                <div class="w-100" style="max-width: 320px;">
                    <h3 class="mb-4">Register</h3>

                    <x-blocks.form action="{{ route('register') }}" method="POST">

                        <x-elements.input label="First name" placeholder="Enter your first name" name="first_name" type="text" :value="old('first_name')"  />
                        <x-elements.input label="Last name" placeholder="Enter your last name" name="last_name" type="text" :value="old('last_name')"  />
                        <x-elements.input label="Email" placeholder="Enter your email" name="email" type="email" :value="old('email')"  />
                        <x-elements.input label="Phone" placeholder="Enter your phone number" name="phone" type="text" :value="old('phone')"  />
                        <x-elements.select label="Company" name="company_id">
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </x-elements.select>
                        <x-elements.input label="Password" placeholder="Enter your password" name="password" type="password" />
                        <x-elements.input labelFor="password_confirmation" label="Confirm password" placeholder="Confirm your password" name="password_confirmation" type="password" />

                        <div class="d-flex flex-column mt-2">
                            <a href="#" class="small mb-4 text-decoration-none text-secondary opacity-75 fs-5"><u>Forgot your password?</u></a>
                            <button type="submit" class="btn btn-primary">register</button>
                        </div>

                        <x-blocks.message />
                        <x-blocks.error-alert />
                    </x-blocks.form>
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

{{--https://cdn.pixabay.com/photo/2015/06/23/08/16/daegwallyeong-818420_1280.jpg--}}
{{--https://cdn.pixabay.com/photo/2023/05/11/10/43/windmills-7986053_1280.jpg--}}
{{--https://images.pexels.com/photos/414837/pexels-photo-414837.jpeg--}}

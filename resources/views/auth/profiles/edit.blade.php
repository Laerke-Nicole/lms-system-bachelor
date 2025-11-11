@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-3 d-flex flex-column gap-3 margin-screen">
            <div>
                <h3>Hi, {{ Auth::user()->first_name }}</h3>
                <p class="fs-5">{{ Auth::user()->email }}</p>
            </div>

            <ul class="text-label-1 list-unstyled d-flex flex-column gap-4">
                <li><a href="" class="text-decoration-underline-hover">Personal information</a></li>
                <li><a href="" class="text-decoration-underline-hover">Certificates</a></li>
                <li><a href="" class="text-decoration-underline-hover">Contact & help</a></li>
                <li>
                    <x-blocks.form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">
                        <button type="submit" class="text-link text-label text-decoration-underline-hover p-0 border-0 mb-0 mm-listitem__btn mm-listitem__text w-100 d-flex align-items-start">Logout</button>
                    </x-blocks.form>
                </li>
            </ul>
        </div>

        <div class="col-lg-9 margin-screen">
            <h3>Personal information</h3>
            <p class="mb-5">Here you can update your information so your details are up-to-date.</p>

            <div class="margin-screen">
                <x-blocks.form action="{{ route('profiles.update') }}" method="POST" class="mb-0">
                    @method('PUT')

                    <div class="row">
                        <x-elements.input col="col-lg-6" label="First name" name="first_name" value="{{ $user->first_name }}"/>
                        <x-elements.input col="col-lg-6" label="Last name" name="last_name" value="{{ $user->last_name }}"/>
                    </div>
                    <x-elements.input col="col-12" label="Email" name="email" value="{{ $user->email }}"/>
                    <x-elements.input col="col-12" label="Phone" name="phone" value="{{ $user->phone }}"/>

                    <div class="d-flex flex-wrap align-items-baseline gap-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </x-blocks.form>

                <x-blocks.error-alert/>
            </div>

            <div class="row">
                <div class="col-9">
                    <label class="form-label text-label">Your password</label>
                    <p>**************</p>
                </div>

                <div class="col-3 d-flex justify-content-end">
                    <a href=""><i class="bi bi-pencil me-2"></i></a>
                </div>
            </div>
        </div>
    </div>


@endsection

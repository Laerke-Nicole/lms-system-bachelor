@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-3 d-flex flex-column gap-3 section-spacing">
            <div>
                <h3>Hi, {{ Auth::user()->first_name }}</h3>
            </div>

            <ul class="text-label-1 list-unstyled d-flex flex-column gap-4">
                <li><a href="{{ route('profiles.edit') }}" class="text-decoration-underline-hover">Personal information</a></li>
                <li><a href="{{ route('profiles.certificates') }}" class="text-decoration-underline-hover">Certificates</a></li>
                <li><a href="{{ route('profiles.contacts') }}" class="text-decoration-underline-hover">Contact us</a></li>
                <li><a href="{{ route('gdprs.privacy-policy') }}" class="text-decoration-underline-hover">Privacy policy</a></li>
                <li>
                    <x-blocks.form action="{{ route('logout') }}" method="POST" class="mb-0 w-100">
                        <button type="submit" class="text-link text-label-1 text-decoration-underline-hover p-0 border-0 mm-listitem__btn mm-listitem__text w-100 d-flex align-items-start">Logout</button>
                    </x-blocks.form>
                </li>
            </ul>
        </div>

        <div class="col-lg-9 section-spacing">
            @yield('profile-content')
        </div>
    </div>

@endsection

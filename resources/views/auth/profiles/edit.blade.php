@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <h4>Hi, {{ Auth::user()->first_name }}</h4>
            <p>{{ Auth::user()->email }}</p>

            <ul>
                <li>Personal information</li>
                <li>Certificates</li>
                <li>Contact & help</li>
            </ul>
        </div>

        <div class="col-lg-9">
            <h2>Personal information</h2>

            <x-blocks.error-alert/>

            <x-blocks.form action="{{ route('profiles.update') }}" method="POST">
                @method('PUT')

                <x-elements.input col="col-12 col-lg-4" label="First name" name="first_name" value="{{ $user->first_name }}"/>
                <x-elements.input col="col-12 col-lg-4" label="Last name" name="last_name" value="{{ $user->last_name }}"/>
                <x-elements.input col="col-12 col-lg-4" label="Email" name="email" value="{{ $user->email }}"/>
                <x-elements.input col="col-12 col-lg-4" label="Phone" name="phone" value="{{ $user->phone }}"/>

                <div class="d-flex flex-wrap align-items-baseline gap-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </x-blocks.form>
        </div>
    </div>


@endsection

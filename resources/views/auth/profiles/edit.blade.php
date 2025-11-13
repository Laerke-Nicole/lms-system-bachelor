@extends('layouts.profile')

@section('profile-content')


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

    <x-blocks.message />

    <x-blocks.error-alert/>
</div>

<div class="row">
    <div class="col-9">
        <label class="form-label text-label">Your password</label>
        <p>**************</p>
    </div>

    <div class="col-3 d-flex justify-content-end">
        <x-sections.modal id="changePasswordModal" modalLabel="changePasswordModalLabel" title="Change your password">
            hej
        </x-sections.modal>
    </div>
</div>

@endsection

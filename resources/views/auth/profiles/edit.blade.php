@extends('layouts.profile')

@section('profile-content')


<h3>Personal information</h3>
<p class="mb-5">Here you can update your information so your details are up-to-date.</p>

<div>
    <x-blocks.form action="{{ route('profiles.update') }}" method="POST" class="mb-0">
        @method('PUT')

        <div class="section-spacing">
            <div class="row">
                <x-elements.input col="col-lg-6" label="First name" name="first_name" value="{{ $user->first_name }}"/>
                <x-elements.input col="col-lg-6" label="Last name" name="last_name" value="{{ $user->last_name }}"/>
            </div>
            <x-elements.input col="col-12" label="Email" name="email" value="{{ $user->email }}"/>
            <x-elements.input col="col-12" label="Phone" name="phone" value="{{ $user->phone }}"/>

            <div class="row mb-2">
                <div class="col-12">
                    <input type="hidden" name="leader_can_view_info" value="0">

                    <x-elements.input label="Allow your leader to view your information? (Needed for them to book you)" name="leader_can_view_info" type="checkbox" value="1" class="form-check-input" col="col-5" :required="false" :checked="(bool) $user->leader_can_view_info" />
                </div>
            </div>

            <div class="d-flex flex-wrap align-items-baseline gap-2 mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            <x-blocks.message />

            <x-blocks.error-alert/>
        </div>
    </x-blocks.form>

    <div class="row mb-3">
        <div class="col-9">
            <label class="form-label text-label-1">Your password</label>
            <p>**************</p>
        </div>

        <div class="col-3 d-flex justify-content-end">
            <a href=""><i class="bi bi-pencil"></i></a>
        </div>
    </div>
</div>



@endsection

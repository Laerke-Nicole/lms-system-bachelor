@extends('layouts.profile')

@section('profile-content')


<h3>Personal information</h3>
<p class="mb-5">Here you can update your information so your details are up-to-date.</p>

<div>
    <x-blocks.form action="{{ route('profiles.update') }}" method="POST" class="mb-0">
        @method('PUT')

        <div class="section-spacing">
            <div class="row">
                @if($user->first_name)
                    <x-elements.input col="col-lg-6" label="First name" name="first_name" value="{{ $user->first_name }}"/>
                @endif
                @if($user->last_name)
                    <x-elements.input col="col-lg-6" label="Last name" name="last_name" value="{{ $user->last_name }}"/>
                @endif
            </div>

            @if($user->email)
                <x-elements.input col="col-12" label="Email" name="email" value="{{ $user->email }}"/>
            @endif
            @if($user->phone)
                <x-elements.input col="col-12" label="Phone" name="phone" value="{{ $user->phone }}"/>
            @endif

            <div class="row mb-2">
                <div class="col-12">
                    <input type="hidden" name="leader_can_view_info" value="0">

                    <x-elements.input label="Allow your leader to view your information? (Needed for them to book you and gives them access to seeing your certificates)"
                                      name="leader_can_view_info"
                                      type="checkbox"
                                      value="1"
                                      class="form-check-input"
                                      col="col-12 col-md-6"
                                      labelClass=""
                                      formGroupClass="d-flex flex-row-reverse gap-2"
                                      :required="false"
                                      :checked="(bool) $user->leader_can_view_info"
                    />
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
{{--        change your password --}}
        <div class="col-9">
            <label class="form-label text-label-1">Your password</label>
            <p>**************</p>
        </div>

        <div class="col-3 d-flex justify-content-end">
            <a href="{{ route('profiles.password.edit') }}">
                <i class="bi bi-pencil"></i>
            </a>
        </div>
    </div>
</div>



@endsection

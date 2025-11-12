@extends('layouts.profile')

@section('profile-content')


    <h3>Contact</h3>
    <p class="mb-5">If you have any questions or need assistance, please feel free to reach out to us.</p>

    <div class="row">
        <x-blocks.detail field="Phone" title="{{ $ab_inventech->ab_inventech_phone }}"></x-blocks.detail>
        <x-blocks.detail field="Mail" title="{{ $ab_inventech->ab_inventech_mail }}"></x-blocks.detail>
        <x-blocks.show-address :table="$ab_inventech" />
    </div>


@endsection

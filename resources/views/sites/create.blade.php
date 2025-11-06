@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('sites.index') }}" title="Add new site"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('sites.store') }}" method="POST">
        <x-elements.input col="col-12 col-lg-4" label="Name" name="site_name" />
        <x-elements.input col="col-12 col-lg-4" label="Mail" name="site_mail" />
        <x-elements.input col="col-12 col-lg-4" label="Phone" name="site_phone" />
        <x-elements.input col="col-12 col-lg-4" label="Company" name="company_id" />
{{--        <x-elements.input col="col-12 col-lg-4" label="Address" name="address_id" />--}}

        <button type="submit" class="btn btn-primary">Submit</button>
    </x-blocks.form>

@endsection

@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('companies.index') }}" title="Add new company"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('companies.store') }}" method="POST">
        <x-elements.input col="col-12 col-lg-4" label="Name" name="company_name" />
        <x-elements.input col="col-12 col-lg-4" label="Mail" name="company_mail" />
        <x-elements.input col="col-12 col-lg-4" label="Phone" name="company_phone" />
        <x-elements.input col="col-12 col-lg-4" label="Is Vestas?" name="is_vestas" type="checkbox" class="form-check-input" />
        <x-elements.input col="col-12 col-lg-4" label="Address" name="address_id" />

        <button type="submit" class="btn btn-primary">Submit</button>
    </x-blocks.form>

@endsection

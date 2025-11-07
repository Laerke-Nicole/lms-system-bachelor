@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('companies.index') }}" title="Add new company"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('companies.store') }}" method="POST">
        <x-elements.input col="col-12 col-lg-4" label="Name" name="company_name" />
        <x-elements.input col="col-12 col-lg-4" label="Mail" name="company_mail" />
        <x-elements.input col="col-12 col-lg-4" label="Phone" name="company_phone" />
        <x-elements.input col="col-12 col-lg-4" label="Is Vestas?" name="is_vestas" type="checkbox" class="form-check-input" :required="false" />
        <x-elements.input col="col-12 col-lg-4" label="Street Name" name="street_name" />
        <x-elements.input col="col-12 col-lg-4" label="Street Number" name="street_number" />
        <x-elements.input col="col-12 col-lg-4" label="Postal Code" name="postal_code" />
        <x-elements.input col="col-12 col-lg-4" label="City" name="city" />
        <x-elements.input col="col-12 col-lg-4" label="Country" name="country" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

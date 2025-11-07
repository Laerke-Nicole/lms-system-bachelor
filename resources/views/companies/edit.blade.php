@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('companies.index') }}" title="Edit company"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('companies.update', $company->id) }}" method="post">
        @method('PUT')

        <x-elements.input col="col-12 col-lg-4" label="Name" name="company_name" value="{{ $company->company_name }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Mail" name="company_mail" value="{{ $company->company_mail }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Phone" name="company_phone" value="{{ $company->company_phone }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Is Vestas?" name="is_vestas" type="checkbox" class="form-check-input" :required="false" />
        <x-elements.input col="col-12 col-lg-4" label="Street Name" name="street_name" value="{{ $company->address->street_name }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Street Number" name="street_number" value="{{ $company->address->street_number }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Postal Code" name="postal_code" value="{{ $company->address->postalCode->postal_code }}"/>
        <x-elements.input col="col-12 col-lg-4" label="City" name="city" value="{{ $company->address->postalCode->city }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Country" name="country" value="{{ $company->address->postalCode->country }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

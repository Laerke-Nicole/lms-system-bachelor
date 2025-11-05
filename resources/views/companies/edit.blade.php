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
        <x-elements.input col="col-12 col-lg-4" label="Is Vestas?" name="is_vestas" value="{{ $company->is_vestas }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Address" name="address_id" value="{{ $company->address_id }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

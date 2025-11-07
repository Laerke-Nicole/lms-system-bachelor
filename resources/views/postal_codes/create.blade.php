@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('postal_codes.index') }}" title="Add new postal code"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('postal_codes.store') }}" method="POST">
        <x-elements.input col="col-12 col-lg-4" label="Postal Code" name="postal_code" />
        <x-elements.input col="col-12 col-lg-4" label="City" name="city" />
        <x-elements.input col="col-12 col-lg-4" label="Country" name="country" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

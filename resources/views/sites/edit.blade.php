@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('sites.index') }}" title="Edit {{ $site->site_name }}" tagline="Site for {{ $site->company->company_name }}"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('sites.update', $site->id) }}" method="POST">
        @method('PUT')

        <x-elements.input col="col-12 col-lg-4" label="Name" name="site_name" value="{{ $site->site_name }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Mail" name="site_mail" value="{{ $site->site_mail }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Phone" name="site_phone" value="{{ $site->site_phone }}"/>
        <x-blocks.edit-address :table="$site" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

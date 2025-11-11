@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('sites.index') }}" title="{{ $site->site_name }}" tagline="Site for {{ $site->company->company_name }}"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Name:" title="{{ $site->site_name }}"></x-blocks.detail>
        <x-blocks.detail field="Mail:" title="{{ $site->site_mail }}"></x-blocks.detail>
        <x-blocks.detail field="Phone:" title="{{ $site->site_phone }}"></x-blocks.detail>
        <x-blocks.detail field="Company:" title="{{ $site->company->company_name }}"></x-blocks.detail>
        <x-blocks.show-address :table="$site" />
    </div>

@endsection

@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Sites',
        'sites.index',
        'View',
        'sites.show',
        $site
    ) }}

    <x-blocks.title title="{{ $site->site_name }}" subTitle="Site for {{ $site->company->company_name }}" />

    <div class="row">
        <x-blocks.detail field="Name" title="{{ $site->site_name }}" />
        <x-blocks.detail field="Mail" title="{{ $site->site_mail }}" />
        <x-blocks.detail field="Phone" title="{{ $site->site_phone }}" />
        <x-blocks.detail field="Company" title="{{ $site->company->company_name }}" />
        <x-blocks.show-address :table="$site" />
    </div>

@endsection

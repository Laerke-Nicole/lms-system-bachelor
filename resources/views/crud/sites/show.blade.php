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

    @if($site->company)
        <x-blocks.title title="{{ $site->site_name }}" subTitle="Site for {{ $site->company->company_name }}" />
    @else
        <x-blocks.title title="{{ $site->site_name }}" />
    @endif

    <div class="row">
        <x-blocks.detail field="Name" title="{{ $site->site_name }}" />
        @if($site->site_mail)
            <x-blocks.detail field="Mail" title="{{ $site->site_mail }}" />
        @endif
        @if($site->site_phone)
            <x-blocks.detail field="Phone" title="{{ $site->site_phone }}" />
        @endif
        @if($site->company)
            <x-blocks.detail field="Company" title="{{ $site->company->company_name }}" />
        @endif
        <x-blocks.show-address :table="$site" />
    </div>

@endsection

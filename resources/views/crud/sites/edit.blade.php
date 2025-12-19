@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Sites',
        'sites.index',
        'Edit',
        'sites.edit',
        $site
    ) }}

    <x-blocks.title title="Edit {{ $site->site_name }}" subTitle="Site for {{ $site->company->company_name }}" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('sites.update', $site->id) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Name" name="site_name" value="{{ $site->site_name }}"/>
        <x-elements.input label="Mail" name="site_mail" value="{{ $site->site_mail }}"/>
        <x-elements.input label="Phone" name="site_phone" value="{{ $site->site_phone }}"/>
        <x-blocks.edit-address :table="$site" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

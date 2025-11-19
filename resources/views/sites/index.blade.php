@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Sites', 'sites.index') }}

    <x-blocks.title href="{{ route('sites.create') }}" title="Sites" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Site name', 'Mail', 'Phone', 'Address', 'Company', 'Actions']">
        @foreach ($sites as $site)
            <tr>
                <td>{{ $site->site_name }}</td>
                <td>{{ $site->site_mail }}</td>
                <td>{{ $site->site_phone }}</td>
                <td><x-blocks.index-address :table="$site" /></td>
                <td>{{ $site->company->company_name }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('sites.show', $site->id)"
                                                :editRoute="route('sites.edit', $site->id)"
                                                :deleteRoute="route('sites.destroy', $site->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$sites"/>

@endsection

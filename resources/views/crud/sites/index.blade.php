@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Sites', 'sites.index') }}

    <x-blocks.title href="{{ route('sites.create') }}" title="Sites" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="[
        ['label' => 'Site name'],
        ['label' => 'Mail', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Phone', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Address', 'class' => 'd-none d-xl-table-cell'],
        ['label' => 'Company', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Actions'],
        ]">
        @forelse ($sites as $site)
            <tr>
                <td>{{ $site->site_name }}</td>
                <td class="d-none d-md-table-cell">{{ $site->site_mail }}</td>
                <td class="d-none d-lg-table-cell">{{ $site->site_phone }}</td>
                <td class="d-none d-xl-table-cell"><x-blocks.index-address :table="$site" /></td>
                <td class="d-none d-lg-table-cell">{{ $site->company->company_name }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('sites.show', $site->id)"
                                                :editRoute="route('sites.edit', $site->id)"
                                                :deleteRoute="route('sites.destroy', $site->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">There are no sites.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$sites"/>

@endsection

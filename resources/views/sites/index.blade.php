@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('sites.create') }}" title="Sites" buttonText="Create new site"/>

    <x-blocks.message/>

    <x-blocks.table :headers="['Site name', 'Mail', 'Phone', 'Company', 'Address', 'Actions']">
        @foreach ($sites as $site)
            <tr>
                <td>{{ $site->site_name }}</td>
                <td>{{ $site->site_mail }}</td>
                <td>{{ $site->site_phone }}</td>
                <td>{{ $site->company_id }}</td>
{{--                <td>{{ $site->address_id }}</td>--}}
                <td>
                    <x-blocks.table-row-actions :showRoute="route('sites.show', $site->id)"
                                                :editRoute="route('sites.edit', $site->id)"
                                                :deleteRoute="route('sites.destroy', $site->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table>


    <x-elements.pagination :items="$sites"/>

@endsection

@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Companies', 'companies.index') }}

    <x-blocks.title href="{{ route('companies.create') }}" title="Companies" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Company name', 'Mail', 'Phone', 'Address', 'Actions']">
        @forelse ($companies as $company)
            <tr>
                <td>{{ $company->company_name }}</td>
                <td>{{ $company->company_mail ?? '-' }}</td>
                <td>{{ $company->company_phone ?? '-' }}</td>
                <td><x-blocks.index-address :table="$company" /></td>

                <td>
                    <x-blocks.table-actions :showRoute="route('companies.show', $company->id)"
                                                :editRoute="route('companies.edit', $company->id)"
                                                :deleteRoute="route('companies.destroy', $company->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">There are no companies.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$companies"/>

@endsection

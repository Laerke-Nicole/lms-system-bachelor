@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('companies.create') }}" title="Companies" buttonText="Create new company"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Company name', 'Mail', 'Phone', 'Is Vestas?', 'Address', 'Actions']">
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->company_name }}</td>
                <td>{{ $company->company_mail }}</td>
                <td>{{ $company->company_phone }}</td>
                <td>{{ $company->is_vestas ? 'True' : 'False' }}</td>
                <td><x-blocks.index-address :table="$company" /></td>

                <td>
                    <x-blocks.table-actions :showRoute="route('companies.show', $company->id)"
                                                :editRoute="route('companies.edit', $company->id)"
                                                :deleteRoute="route('companies.destroy', $company->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$companies"/>

@endsection

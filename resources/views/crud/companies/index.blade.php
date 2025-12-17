@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Companies', 'companies.index') }}

    <x-blocks.title href="{{ route('companies.create') }}" title="Companies" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="[
        ['label' => 'Company name'],
        ['label' => 'Mail', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Phone', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Address', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Actions'],
        ]">
        @forelse ($companies as $company)
            <tr>
                <td>{{ $company->company_name }}</td>
                <td class="d-none d-md-table-cell">{{ $company->company_mail ?? '-' }}</td>
                <td class="d-none d-lg-table-cell">{{ $company->company_phone ?? '-' }}</td>
                <td class="d-none d-lg-table-cell"><x-blocks.index-address :table="$company" /></td>

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

@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <x-blocks.title href="{{ route('companies.index') }}" title="{{ $company->company_name }}"
                            buttonText="Go back"></x-blocks.title>
        </div>

        <div class="col-lg-6 d-flex flex-column justify-content-end align-items-end mb-5">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#company">Company</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sites">Sites</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#users">Users</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <x-blocks.detail field="Name" title="{{ $company->company_name }}"></x-blocks.detail>
        <x-blocks.detail field="Mail" title="{{ $company->company_mail }}"></x-blocks.detail>
        <x-blocks.detail field="Phone" title="{{ $company->company_phone }}"></x-blocks.detail>
        <x-blocks.show-address :table="$company" />
    </div>

@endsection

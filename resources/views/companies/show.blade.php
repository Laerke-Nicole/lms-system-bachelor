@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('companies.index') }}" title="{{ $company->company_name }}"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Name:" title="{{ $company->company_name }}"></x-blocks.detail>
        <x-blocks.detail field="Mail:" title="{{ $company->company_mail }}"></x-blocks.detail>
        <x-blocks.detail field="Phone:" title="{{ $company->company_phone }}"></x-blocks.detail>
        <x-blocks.detail field="Is Vestas?:" title="{{ $company->is_vestas ? 'True' : 'False' }}"></x-blocks.detail>
        <x-blocks.show-address :table="$company" />
    </div>

@endsection

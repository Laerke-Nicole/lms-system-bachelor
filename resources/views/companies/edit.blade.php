@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('company', $company, 'Edit') }}

    <x-blocks.title title="Edit {{ $company->company_name }}"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input label="Name" name="company_name" value="{{ $company->company_name }}"/>
        <x-elements.input label="Mail" name="company_mail" value="{{ $company->company_mail }}"/>
        <x-elements.input label="Phone" name="company_phone" value="{{ $company->company_phone }}"/>
        <x-blocks.edit-address :table="$company" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('companies.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

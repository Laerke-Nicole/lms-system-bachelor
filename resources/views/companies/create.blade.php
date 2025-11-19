@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.create',
        'Companies',
        'companies.index',
        'Create',
        'companies.create'
    ) }}


    <x-blocks.title title="Create new company"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        <x-elements.input label="Name" name="company_name" />
        <x-elements.input label="Mail" name="company_mail" />
        <x-elements.input label="Phone" name="company_phone" />
        <x-blocks.create-address />
        <x-elements.input label="Is Vestas?" name="is_vestas" type="checkbox" class="form-check-input" :required="false" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

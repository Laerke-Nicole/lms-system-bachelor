@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.create',
        'Sites',
        'sites.index',
        'Create',
        'sites.create'
    ) }}


    <x-blocks.title title="Create new site"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('sites.store') }}" method="POST">
        <x-elements.input label="Name" name="site_name" />
        <x-elements.input label="Mail" name="site_mail" />
        <x-elements.input label="Phone" name="site_phone" />
        <x-elements.select label="Company" name="company_id">
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </x-elements.select>
        <x-blocks.create-address />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('companies.index') }}" title="Show company"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Name:" title="{{ optional($company)->company_name }}"></x-blocks.detail>
        <x-blocks.detail field="Mail:" title="{{ optional($company)->company_mail }}"></x-blocks.detail>
        <x-blocks.detail field="Phone:" title="{{ optional($company)->company_phone }}"></x-blocks.detail>
        <x-blocks.detail field="Is Vestas?:" title="{{ optional($company)->is_vestas ? 'True' : 'False' }}"></x-blocks.detail>
        <x-blocks.detail field="Address:" title="{{ optional($company)->address_id }}"></x-blocks.detail>
    </div>

@endsection

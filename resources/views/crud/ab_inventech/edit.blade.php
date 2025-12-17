@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'AB Inventech',
        'ab_inventech.index',
        'Edit',
        'ab_inventech.edit',
        $abInventech
    ) }}

    <x-blocks.title title="Edit {{ $abInventech->ab_inventech_name }}'s information" />

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('ab_inventech.update', $abInventech->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input label="Name" name="ab_inventech_name" value="{{ $abInventech->ab_inventech_name }}"/>
        <x-elements.input label="Email" name="ab_inventech_mail" value="{{ $abInventech->ab_inventech_mail }}"/>
        <x-elements.input label="Phone" name="ab_inventech_phone" value="{{ $abInventech->ab_inventech_phone }}"/>
        <x-elements.input label="Logo" name="logo" type="file" :required="false" />
        <div class="w-50 mb-3">
            <img src="{{ asset('storage/' . $abInventech->logo) }}" alt="{{ basename($abInventech->logo) }}" class="'w-50 img-fluid">
        </div>
        <x-blocks.edit-address :table="$abInventech" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('ab_inventech.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

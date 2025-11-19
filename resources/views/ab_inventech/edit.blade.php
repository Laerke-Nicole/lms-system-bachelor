@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('ab_inventech', $abInventech, 'Edit') }}

    <x-blocks.title title="Edit {{ $abInventech->ab_inventech_name }}'s information"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('ab_inventech.update', $abInventech->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input label="Name" name="ab_inventech_name" value="{{ $abInventech->ab_inventech_name }}"/>
        <x-elements.input label="Email" name="ab_inventech_mail" value="{{ $abInventech->ab_inventech_mail }}"/>
        <x-elements.input label="Phone" name="ab_inventech_phone" value="{{ $abInventech->ab_inventech_phone }}"/>
        <x-elements.input label="Logo" name="logo" type="file" :required="false" />
        <x-blocks.detail :isImage="true" :title="$abInventech->logo"></x-blocks.detail>
        <x-blocks.edit-address :table="$abInventech" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('ab_inventech.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

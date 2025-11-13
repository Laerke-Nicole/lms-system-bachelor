@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('ab_inventech.index') }}" title="Edit AB Inventech's information"
                    buttonText="Go back"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('ab_inventech.update', $abInventech->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        <x-elements.input col="col-12 col-lg-4" label="Name" name="ab_inventech_name" value="{{ $abInventech->ab_inventech_name }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Email" name="ab_inventech_mail" value="{{ $abInventech->ab_inventech_mail }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Phone" name="ab_inventech_phone" value="{{ $abInventech->ab_inventech_phone }}"/>
        <x-elements.input col="col-12 col-lg-4" label="Logo" name="logo" type="file" :required="false" />
        <x-blocks.detail :isImage="true" :title="$abInventech->logo"></x-blocks.detail>
        <x-blocks.edit-address :table="$abInventech" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('ab_inventech.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

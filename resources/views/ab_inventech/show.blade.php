@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('ab_inventech.index') }}" title="{{ $abInventech->ab_inventech_name }}"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Email" title="{{ $abInventech->ab_inventech_mail }}"></x-blocks.detail>
        <x-blocks.detail field="Phone" title="{{ $abInventech->ab_inventech_phone }}"></x-blocks.detail>
        <x-blocks.show-address :table="$abInventech" />
    </div>

@endsection

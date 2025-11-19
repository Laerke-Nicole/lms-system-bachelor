@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('ab_inventech', $abInventech, 'View') }}

    <x-blocks.title title="{{ $abInventech->ab_inventech_name }}"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Email" title="{{ $abInventech->ab_inventech_mail }}"></x-blocks.detail>
        <x-blocks.detail field="Phone" title="{{ $abInventech->ab_inventech_phone }}"></x-blocks.detail>
        <x-blocks.show-address :table="$abInventech" />
    </div>

@endsection

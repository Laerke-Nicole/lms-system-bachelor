@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'AB Inventech',
        'ab_inventech.index',
        'View',
        'ab_inventech.show',
        $abInventech
    ) }}

    <x-blocks.title title="{{ $abInventech->ab_inventech_name }}" />

    <div class="row">
        <x-blocks.detail field="Email" title="{{ $abInventech->ab_inventech_mail }}" />
        <x-blocks.detail field="Phone" title="{{ $abInventech->ab_inventech_phone }}" />
        <x-blocks.show-address :table="$abInventech" />
    </div>

@endsection

@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'GDPR',
        'gdprs.index',
        'View',
        'gdprs.show',
        $gdpr
    ) }}

    <x-blocks.title title="{{ $gdpr->title }}" />

    <div class="row">
        <x-blocks.detail field="Title" title="{{ $gdpr->title }}" />
        <x-blocks.detail field="Content" title="{{ $gdpr->content }}" />
    </div>

@endsection

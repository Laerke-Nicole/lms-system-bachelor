@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Users',
        'users.index',
        'View',
        'users.show',
        $user
    ) }}

    <x-blocks.title title="{{ $gdpr->title }}" />

    <div class="row">
        <x-blocks.detail field="Title" title="{{ $gdpr->title }}" />
        <x-blocks.detail field="Content" title="{{ $gdpr->content }}" />
    </div>

@endsection

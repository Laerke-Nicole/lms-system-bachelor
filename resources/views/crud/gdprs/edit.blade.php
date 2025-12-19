@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'GDPR',
        'gdprs.index',
        'Edit',
        'gdprs.edit',
        $gdpr
    ) }}

    <x-blocks.title title="Edit" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('gdprs.update', $gdpr->id) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $gdpr->title }}"/>
        <x-elements.textarea label="Content" name="content" value="{{ $gdpr->content }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('gdprs.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

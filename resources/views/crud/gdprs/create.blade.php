@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.create',
        'GDPR',
        'gdprs.index',
        'Create',
        'gdprs.create'
    ) }}


    <x-blocks.title title="Create new gdpr text" />

    <x-blocks.message/>

    <x-blocks.form action="{{ route('gdprs.store') }}" method="POST">
        <x-elements.input label="Title" name="title" />
        <x-elements.textarea label="Content" name="content" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('gdprs.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

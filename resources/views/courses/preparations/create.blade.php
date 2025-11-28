@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.create',--}}
{{--        'Preparations',--}}
{{--        'preparations.index',--}}
{{--        'Create',--}}
{{--        'preparations.create'--}}
{{--    ) }}--}}


    <x-blocks.title title="Create new preparation"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.preparations.store', $course) }}" method="POST">
        <x-elements.input label="Title" name="title" />
        <x-elements.select label="Type" name="type">
            @foreach($types as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input label="URL (optional)" placeholder="URL" name="url" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.preparations.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

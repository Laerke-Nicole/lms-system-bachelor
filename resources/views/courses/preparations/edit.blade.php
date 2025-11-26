@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.show',--}}
{{--        'Courses.Preparations',--}}
{{--        'courses.preparations.index',--}}
{{--        'Edit',--}}
{{--        'courses.preparations.edit',--}}
{{--        $course--}}
{{--    ) }}--}}

    <x-blocks.title title="Edit preparation {{ $preparation->title }}"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.preparations.update', [$course->id, $preparation->id]) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $preparation->title }}"/>
        <x-elements.select label="Type" name="type">
            @foreach($types as $type)
                <option value="{{ $type }}" {{ $preparation->type === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input label="Url" name="url" value="{{ $preparation->url }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.preparations.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

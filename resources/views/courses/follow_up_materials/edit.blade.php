@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.show',--}}
{{--        'Courses.Follow Up Materials',--}}
{{--        'courses.follow_up_materials.index',--}}
{{--        'Edit',--}}
{{--        'courses.follow_up_materials.edit',--}}
{{--        $course--}}
{{--    ) }}--}}

    <x-blocks.title title="Edit follow up material {{ $followUpMaterial->title }}"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.follow_up_materials.update', [$course, $followUpMaterial]) }}" method="POST">
        @method('PUT')

        <x-elements.input label="Title" name="title" value="{{ $followUpMaterial->title }}"/>
        <x-elements.select label="Type" name="type">
            @foreach($types as $type)
                <option value="{{ $type }}" {{ $followUpMaterial->type === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input label="URL (optional)" placeholder="URL" name="url" value="{{ $followUpMaterial->url }}"/>

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.follow_up_materials.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>


@endsection

@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.create',--}}
{{--        'Follow Up Materials',--}}
{{--        'follow_up_materials.index',--}}
{{--        'Create',--}}
{{--        'follow_up_materials.create'--}}
{{--    ) }}--}}


    <x-blocks.title title="Create new follow up material"></x-blocks.title>

    <x-blocks.error-alert/>

    <x-blocks.form action="{{ route('courses.follow_up_materials.store', $course) }}" method="POST">
        <x-elements.input label="Title" name="title" />
        <x-elements.select label="Type" name="type">
            @foreach($types as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </x-elements.select>
        <x-elements.input label="URL (optional)" placeholder="URL" name="url" />

        <div class="d-flex flex-wrap align-items-baseline gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('courses.follow_up_materials.index', $course) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </x-blocks.form>

@endsection

@extends('layouts.app')

@section('content')

{{--    {{ Breadcrumbs::render(--}}
{{--        'crud.show',--}}
{{--        'Requirements',--}}
{{--        'courses.requirements.index',--}}
{{--        'Show',--}}
{{--        'courses.requirements.show',--}}
{{--        $course--}}
{{--    ) }}--}}


    <x-blocks.title title="{{ $requirement->title }}" />

    <div class="row">
        <x-blocks.detail field="Title" title="{{ $requirement->title }}" />
        <x-blocks.detail field="Content" title="{{ $requirement->content }}" />
    </div>

@endsection

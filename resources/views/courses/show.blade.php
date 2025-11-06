@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('courses.index') }}" title="Show course"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Title:" title="{{ optional($course)->title }}"></x-blocks.detail>
        <x-blocks.detail field="Description:" title="{{ optional($course)->description }}"></x-blocks.detail>
        <x-blocks.detail field="Duration months:" title="{{ optional($course)->duration_months }}"></x-blocks.detail>
        <x-blocks.detail field="Image:" title="{{ optional($course)->image }}"></x-blocks.detail>
    </div>

@endsection

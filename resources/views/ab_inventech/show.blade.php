@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('ab_inventech.index') }}" title="{{ $abInventech->title }} course"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Name" title="{{ $abInventech->ab_inventech_name }}"></x-blocks.detail>
        <x-blocks.detail field="Email" title="{{ $abInventech->ab_inventech_mail }}"></x-blocks.detail>
        <x-blocks.detail field="Phone" title="{{ $abInventech->ab_inventech_phone }}"></x-blocks.detail>
        <x-blocks.detail field="Image" :isImage="true" :title="$abInventech->logo"></x-blocks.detail>
    </div>

@endsection

@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'GDPR', 'gdprs.index') }}

    <x-blocks.title href="{{ route('gdprs.create') }}" title="Text blocks about GDPR" buttonText="Create" link="gdprs/privacy-policy" linkTitle="View privacy policy page" />

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Title', 'Content', 'Actions']">
        @forelse ($gdprs as $gdpr)
            <tr>
                <td>{{ $gdpr->title }}</td>
                <td>{{ Str::limit($gdpr->content, 80) }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('gdprs.show', $gdpr->id)"
                                                :editRoute="route('gdprs.edit', $gdpr->id)"
                                                :deleteRoute="route('gdprs.destroy', $gdpr->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">There are no GDPR text blocks.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$gdprs"/>

@endsection

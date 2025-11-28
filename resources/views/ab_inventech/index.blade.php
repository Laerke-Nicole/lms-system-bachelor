@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'AB Inventech', 'ab_inventech.index') }}

    <x-blocks.title title="AB Inventech"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Name', 'Mail', 'Phone', 'Address', 'Actions']">
        @forelse ($abInventechs as $abInventech)
            <tr>
                <td>{{ $abInventech->ab_inventech_name }}</td>
                <td>{{ $abInventech->ab_inventech_mail }}</td>
                <td>{{ $abInventech->ab_inventech_phone }}</td>
                <td><x-blocks.index-address :table="$abInventech" /></td>
                <td>
                    <x-blocks.table-actions :showRoute="route('ab_inventech.show', $abInventech->id)"
                                                :editRoute="route('ab_inventech.edit', $abInventech->id)"
                                                :deleteRoute="route('ab_inventech.destroy', $abInventech->id)"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">There are no AB Inventech entries.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>


    <x-elements.pagination :items="$abInventechs"/>

@endsection

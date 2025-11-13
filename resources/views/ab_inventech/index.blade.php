@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div>
                <h3>AB Inventech</h3>
            </div>
        </div>
    </div>

    <x-blocks.message/>

    <x-blocks.table-head :headers="['Title', 'Description', 'Duration months', 'Actions']">
        @foreach ($abInventechs as $abInventech)
            <tr>
                <td>{{ $abInventech->ab_inventech_name }}</td>
                <td>{{ $abInventech->ab_inventech_mail }}</td>
                <td>{{ $abInventech->ab_inventech_phone }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('ab_inventech.show', $abInventech->id)"
                                                :editRoute="route('ab_inventech.edit', $abInventech->id)"
                                                :deleteRoute="route('ab_inventech.destroy', $abInventech->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table-head>


    <x-elements.pagination :items="$abInventechs"/>

@endsection

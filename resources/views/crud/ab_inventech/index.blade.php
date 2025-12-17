@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'AB Inventech', 'ab_inventech.index') }}

    <x-blocks.title title="AB Inventech"/>

    <x-blocks.message/>

    @if($abInventechs)
        <x-blocks.table-head :headers="[
        ['label' => 'Name'],
        ['label' => 'Mail', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Phone', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Address', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Actions'],
        ]">
            @forelse ($abInventechs as $abInventech)
                <tr>
                    <td>{{ $abInventech->ab_inventech_name }}</td>
                    <td class="d-none d-md-table-cell">{{ $abInventech->ab_inventech_mail }}</td>
                    <td class="d-none d-lg-table-cell">{{ $abInventech->ab_inventech_phone }}</td>
                    <td class="d-none d-lg-table-cell"><x-blocks.index-address :table="$abInventech" /></td>
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
    @endif


    <x-elements.pagination :items="$abInventechs"/>

@endsection

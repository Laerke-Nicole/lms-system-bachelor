@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('postal_codes.create') }}" title="Postal Codes" buttonText="Create New Postal Code"/>

    <x-blocks.message/>

    <x-blocks.table :headers="['Postal Code', 'City', 'Country', 'Actions']">
        @foreach ($postalCodes as $postalCode)
            <tr>
                <td>{{ $postalCode->postal_code }}</td>
                <td>{{ $postalCode->city }}</td>
                <td>{{ $postalCode->country }}</td>
                <td>
                    <x-blocks.table-row-actions :showRoute="route('postal_codes.show', $postalCode->id)"
                                                :editRoute="route('postal_codes.edit', $postalCode->id)"
                                                :deleteRoute="route('postal_codes.destroy', $postalCode->id)"/>
                </td>
            </tr>
        @endforeach
    </x-blocks.table>


    <x-elements.pagination :items="$postalCodes"/>

@endsection

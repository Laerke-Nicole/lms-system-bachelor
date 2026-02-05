@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('to-home', 'Admins', 'admins.index') }}

    <x-blocks.title href="{{ route('admins.create') }}" title="Admins" buttonText="Create"/>

    <x-blocks.message/>

    <x-blocks.table-head :headers="[
        ['label' => 'Full name'],
        ['label' => 'Email', 'class' => 'd-none d-md-table-cell'],
        ['label' => 'Phone', 'class' => 'd-none d-lg-table-cell'],
        ['label' => 'Actions'],
        ]">
        @forelse ($admins as $admin)
            <tr>
                <td>{{ $admin->first_name }} {{ $admin->last_name }}</td>
                <td class="d-none d-md-table-cell">{{ $admin->email }}</td>
                <td class="d-none d-lg-table-cell">{{ $admin->phone }}</td>
                <td>
                    <x-blocks.table-actions :showRoute="route('admins.show', $admin->id)"
                                            :deleteRoute="$admin->id !== auth()->id() ? route('admins.destroy', $admin->id) : null"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">There are no admins.</td>
            </tr>
        @endforelse
    </x-blocks.table-head>

    <x-elements.pagination :items="$admins"/>

@endsection

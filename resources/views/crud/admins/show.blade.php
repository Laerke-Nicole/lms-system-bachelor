@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Admins',
        'admins.index',
        $admin->first_name . ' ' . $admin->last_name,
        'admins.show',
        $admin->id
    ) }}

    <x-blocks.title title="{{ $admin->first_name }} {{ $admin->last_name }}" />

    <x-blocks.message/>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Full name</dt>
                <dd class="col-sm-9">{{ $admin->first_name }} {{ $admin->last_name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $admin->email }}</dd>

                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{ $admin->phone }}</dd>

                <dt class="col-sm-3">Created at</dt>
                <dd class="col-sm-9">{{ $admin->created_at->format('d-m-Y H:i') }}</dd>
            </dl>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">Back to list</a>
        @if($admin->id !== auth()->id())
            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this admin?')">Delete</button>
            </form>
        @endif
    </div>

@endsection

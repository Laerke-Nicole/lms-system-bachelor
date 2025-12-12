@extends('layouts.app')

@section('content')

    <div class="row">
        <img src="{{ asset('storage/' . $trainingUser->temp_signature) }}" class="mb-3" />

        <a href="{{ route('signatures.digital.digital', $trainingUser) }}" class="btn btn-secondary">
            Upload new signature
        </a>

        <form action="{{ route('signatures.digital.digital-submit', $trainingUser) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Confirm signature</button>
        </form>
    </div>

@endsection

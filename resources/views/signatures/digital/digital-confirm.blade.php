@extends('layouts.app')

@section('content')

    <div class="row">
        <x-blocks.title col="col-12" title="Are you satisfied with the certificate?" />

        <img src="{{ asset('storage/' . $trainingUser->temp_signature) }}" class="mb-3" />

        <div class="d-flex gap-2">
            <a href="{{ route('signatures.digital.digital', $trainingUser) }}" class="btn btn-outline-primary">
                Upload new signature
            </a>

            <form action="{{ route('signatures.digital.digital-submit', $trainingUser) }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-primary">Confirm signature</button>
            </form>
        </div>
    </div>

@endsection

@push('fixed-elements')
    <x-blocks.signature-digital-progress-bar :step="3" :trainingUser="$trainingUser" />
@endpush

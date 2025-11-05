@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('postal_codes.index') }}" title="Show postal code"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Postal code:" title="{{ optional($postalCode)->postal_code }}"></x-blocks.detail>
        <x-blocks.detail field="City:" title="{{ optional($postalCode)->city }}"></x-blocks.detail>
        <x-blocks.detail field="Country:" title="{{ optional($postalCode)->country }}"></x-blocks.detail>
    </div>

@endsection

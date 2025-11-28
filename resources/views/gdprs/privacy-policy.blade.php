@extends('layouts.layout')

@section('content')

    <div class="section-spacing bg-light">
        <div class="container">
            {{ Breadcrumbs::render('to-home', 'Privacy policy', 'gdprs.privacy-policy') }}
            <h1>Privacy policy</h1>
        </div>
    </div>
    <div class="container section-spacing">
        <div class="row">
            @foreach($gdprs as $gdpr)
                <div class="col-12 col-md-8">
                    <h3>{{ $gdpr->title }}</h3>
                    <p>{{ $gdpr->content }}</p>
                </div>
            @endforeach

            @if($abInventech)
                <div class="col-12 col-md-8">
                    <h3>Contact us</h3>
                    <p>For questions, contact: </p>
                    <p>Name: {{ $abInventech->ab_inventech_name }}</p>
                    <p>Address: <x-blocks.index-address :table="$abInventech"/></p>
                    <p>Email: {{ $abInventech->ab_inventech_mail }}</p>
                    <p>Website: {{ $abInventech->ab_inventech_web }}</p>
                    <p>Phone: {{ $abInventech->ab_inventech_phone }}</p>
                </div>
            @endif

        </div>
    </div>

@endsection

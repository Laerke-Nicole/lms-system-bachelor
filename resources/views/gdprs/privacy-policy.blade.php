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
        </div>
    </div>

@endsection

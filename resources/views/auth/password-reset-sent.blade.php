@extends('layouts.layout')

@section('content')
    @guest
    <div class="container">
        <div class="row">
            <div class="vh-100 col-12 d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-check-circle fs-1 mb-3 text-success"></i>
                <h3 class="mb-2">Please check your email</h3>
                <p class="fs-5">We have sent you an email with a link to reset your password.</p>

                <p class="fs-5 mb-4">If you didn't receive any emails within a few minutes, check your spam folder.</p>

                <a href="{{ route('login') }}" class="btn btn-primary">Back to login</a>
            </div>
        </div>
    </div>
    @endguest
@endsection

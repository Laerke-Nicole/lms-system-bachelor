@extends('layouts.app')

@section('content')

    <div class="row">
        @include('components.sections.profile-links')

        <div class="col-lg-9 section-spacing">
            @yield('profile-content')
        </div>
    </div>

@endsection

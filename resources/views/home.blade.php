@extends('layouts.app')

@section('content')

    <div class="row mb-5">

{{--        left side--}}
        <div class="col-xl-8">
            <div class="row mb-5">
                <div class="col-12">
                    {{-- welcome message--}}
                    @include('components.sections.welcome-message')
                </div>
            </div>

            {{-- content --}}
            @include('components.sections.homepage-left-side')
        </div>

{{--        right side --}}
        <div class="col-xl-4">
            @include('components.sections.homepage-right-side')
        </div>
    </div>


@endsection

@extends('layouts.app')


@section('content')

    <div class="row mb-5">
{{--        left side--}}
        <div class="col-lg-8">
            <div class="row mb-5">
                <div class="col-12">
                    <h2>Hi, {{ auth()->user()->first_name }}</h2>
                    <p>Welcome, check your learning.</p>
                </div>
            </div>

            {{--    user dashboard --}}
            @if(auth()->user()->role === 'user')
                @include('components/sections/participate-in-training')
                personal training overview, upcoming, completed (and igangværende?)
            @endif

            {{--    leader dashboard --}}
            @if(auth()->user()->role === 'leader')
                Træningstilbud
                @include('components/sections/book-training')
                Status on employees (fx who needs a refresher soon)
                Overview of planned courses for his team
            @endif

            {{--    admin dashboard --}}
            @if(auth()->user()->role === 'admin')
                calendar with all active trainings (all companies and sites) including requests.
                @include('components/sections/create-manage-courses')
            @endif
        </div>

{{--        right side --}}
        <div class="col-lg-4">
            <div class="px-12">
                <div class="row">
                    <div class="bg-white rounded min-vh-100 py-12">
                        {{--    user dashboard --}}
                        @if(auth()->user()->role === 'user')

                        @endif

                        {{--    leader dashboard --}}
                        @if(auth()->user()->role === 'leader')
                            statistic
                        @endif

                        {{--    admin dashboard --}}
                        @if(auth()->user()->role === 'admin')
                            @include('components/sections/statistics')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

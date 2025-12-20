@if(auth()->user()->role === 'admin' || auth()->user()->role === 'user')
    <div class="px-12">
        <div class="row">
            <div class="bg-white rounded min-vh-100 py-12">
                {{--    user dashboard --}}
                @if(auth()->user()->role === 'user')
                    @include('components.sections.homepage-course-materials')
                @endif

{{--                --}}{{--    leader dashboard --}}
{{--                @if(auth()->user()->role === 'leader')--}}
{{--                    --}}
{{--                @endif--}}

                {{--    admin dashboard --}}
                @if(auth()->user()->role === 'admin')
                    @include('components.sections.statistics')
                @endif
            </div>
        </div>
    </div>
@endif

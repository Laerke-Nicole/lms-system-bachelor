{{--    user dashboard --}}
@if(auth()->user()->role === 'user')
{{--    on the day of the training show to participate in training--}}
    @include('components/sections/participate-in-training')
{{--    personal training overview, upcoming, completed--}}
    @include('components/sections/trainings-list-home')
{{--    quick access to materials --}}
@endif

{{--    leader dashboard --}}
@if(auth()->user()->role === 'leader')
{{--    quick access to booking training--}}
    @include('components/sections/book-training')
{{--    Overview of planned courses for his team--}}
    @include('components/sections/trainings-list-home')
@endif

{{--    admin dashboard --}}
@if(auth()->user()->role === 'admin')
{{--    all active trainings--}}
    @include('components/sections/trainings-list-home')
{{--quick links to manage and create new courses--}}
    @include('components/sections/create-manage-courses')
@endif

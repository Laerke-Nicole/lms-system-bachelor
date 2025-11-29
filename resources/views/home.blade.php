@extends('layouts.app')

@section('content')

{{--    showing section where the user participates--}}
    <x-sections.participate-in-training :participateTraining="$participateTraining" />
@endsection

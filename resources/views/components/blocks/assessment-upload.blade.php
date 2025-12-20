@props(['participant', 'participantId'])

{{--upload the assessment--}}
@if(auth()->user()->role === 'admin')
    @if(!$participant->assessment)
        @include('components.elements.assessment-upload')
    @endif
@endif


{{--download the assessment--}}
@if($participant->assessment)
    @include('components.elements.assessment-download')
@endif

{{--delete btn to delete the assessment--}}
@if(auth()->user()->role === 'admin')
    @if($participant->assessment && !$participant->signature)
        @include('components.elements.assessment-delete')
    @endif
@endif

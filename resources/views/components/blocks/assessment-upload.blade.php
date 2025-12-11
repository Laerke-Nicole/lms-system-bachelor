@props(['participant', 'participantId'])

{{--upload the assessment--}}
@if(!$participant->assessment)
    @include('components/elements/assessment-upload')
@endif


{{--download the assessment--}}
@if($participant->assessment)
    @include('components/elements/assessment-download')
@endif

{{--delete btn to delete the assessment--}}
@if($participant->assessment)
    @include('components/elements/assessment-delete')
@endif

@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render(
        'crud.show',
        'Trainings',
        'trainings.index',
        'View',
        'trainings.show',
        $training
    ) }}

    <x-blocks.title title="Training for {{ $training->trainingSlot->course->title }}" />

    <div class="row section-spacing">
        <x-blocks.detail field="Date" title="{{ $training->trainingSlot->training_date->format('d M Y H:i') }}" />
        <x-blocks.detail field="Course" title="{{ $training->trainingSlot->course->title }}" />
        <x-blocks.detail field="Place" title="{{ $training->trainingSlot->place }}" />
        <x-blocks.detail field="Trainer" title="{{ $training->trainingSlot->trainer->first_name}} {{$training->trainingSlot->trainer->last_name }}" />
        <x-blocks.detail field="Ordered by" title="{{ $training->orderedBy->first_name }} {{ $training->orderedBy->last_name }}" secondTitle="{{ $training->orderedBy->email }}" />

        <x-blocks.detail field="Whatsapp link" title="{{ $training->trainingSlot->participation_link }}" />
        @if($training->status === 'Upcoming')
            <x-blocks.detail field="Reminder before training" title="{{ $training->reminder_before_training ?? 'No' }}" />
        @endif
        @if(in_array($training->status, ['Completed', 'Expired']))
            <x-blocks.detail field="Reminder sent 18 months" title="{{ $training->reminder_sent_18_m ? 'Yes' : 'No' }}" />
            <x-blocks.detail field="Reminder sent 22 months" title="{{ $training->reminder_sent_22_m ? 'Yes' : 'No' }}" />
        @endif
        <x-blocks.detail field="Status" title="{{ $training->status }}" />

        @if($certificate)
            <div class="col-12">
                <div class="form-group">
                    <div class="row mb-3">
                        <dt class="col-sm-2 text-dark ">Certificate</dt>
                        <dd class="col-sm-10 lh-md">
                            <a href="{{ route('certificates.certificatePdf', $training->id) }}"><i class="bi bi-download me-2"></i>Download</a>
                        </dd>
                    </div>
                </div>
            </div>
        @endif

{{--        table with users where you can say if the user has completed the test, evaluation or signed --}}
        <livewire:training-participants-completion :training="$training" />

    </div>

@endsection

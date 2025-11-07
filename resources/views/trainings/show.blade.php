@extends('layouts.app')

@section('content')

    <x-blocks.title href="{{ route('trainings.index') }}" title="Show training"
                    buttonText="Go back"></x-blocks.title>

    <div class="row">
        <x-blocks.detail field="Place:" title="{{ optional($training)->place }}"></x-blocks.detail>
        <x-blocks.detail field="Status:" title="{{ optional($training)->status }}"></x-blocks.detail>
        <x-blocks.detail field="Date:" title="{{ optional($training)->training_date }} at {{ optional($training)->training_time }} o'clock"></x-blocks.detail>
        <x-blocks.detail field="Whatsapp link:" title="{{ optional($training)->participation_link }}"></x-blocks.detail>
        <x-blocks.detail field="Reminder sent 18 months:" title="{{ optional($training)->reminder_sent_18_m ? 'True' : 'False' }}"></x-blocks.detail>
        <x-blocks.detail field="Reminder sent 22 months:" title="{{ optional($training)->reminder_sent_22_m ? 'True' : 'False' }}"></x-blocks.detail>
        <x-blocks.detail field="Reminder before training:" title="{{ optional($training)->reminder_before_training }}"></x-blocks.detail>
        <x-blocks.detail field="Extra comments:" title="{{ optional($training)->extra_comments }}"></x-blocks.detail>
        <x-blocks.detail field="Course:" title="{{ optional($training)->course_id }}"></x-blocks.detail>
        <x-blocks.detail field="Ordered by:" title="{{ optional($training)->ordered_by_id }}"></x-blocks.detail>
        <x-blocks.detail field="Trainer:" title="{{ optional($training)->trainer_id }}"></x-blocks.detail>
    </div>

@endsection

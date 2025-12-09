@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 bg-white rounded-3">

                        <x-blocks.title title="Training completion signature" subTitle="Please review the information and provide your signature to confirm that you completed this training." />

                        {{-- Training Summary --}}
                        <div class="mb-4">
                            <div class="d-flex flex-column gap-1">
                                @if($trainingUser->training->trainingSlot->course->title)
                                    <div><span class="text-dark">Course:</span> {{ $trainingUser->training->trainingSlot->course->title }}</div>
                                @endif
                                @if($trainingUser->training->trainingSlot->training_date)
                                    <div><span class="text-dark">Training date:</span> {{ $trainingUser->training->trainingSlot->training_date->format('d M Y') }}</div>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <x-blocks.form action="{{ route('signatures.sign', $trainingUser->id) }}" method="POST" class="mb-0">

                            <div class="mb-3">
                                <x-elements.input label="Sign with your full name" name="signature" placeholder="John Doe" col="col-12" />
                            </div>

                            <x-blocks.error-alert/>

{{--                        confirmation checkbox --}}
                            <x-elements.checkbox
                                label="I hereby confirm I completed the required training, test, and evaluation. And I confirm my signature is correct."
                                name="signature_confirmed"
                                formGroupClass="d-flex gap-2"
                            />

                            <button type="submit" class="btn btn-primary w-100">Submit signature</button>
                        </x-blocks.form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

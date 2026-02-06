<div class="col-12">
    <div class="form-group">
        <dl class="row mb-3">
            {{--            label --}}
            <dt class="col-sm-2 text-dark">Assessment</dt>

            {{--            the value --}}
            <dd class="col-sm-10 lh-md">
                @if($userTrainingRecord->signature && $userTrainingRecord->signature->signature_image)
                    <a href="{{ uploads_url($userTrainingRecord->assessment) }}" target="_blank"><i class="bi bi-download fs-4 me-2"></i>Download</a>
                @else
                    <span class="text-muted">Assessment file not yet available</span>
                @endif
            </dd>
        </dl>
    </div>
</div>

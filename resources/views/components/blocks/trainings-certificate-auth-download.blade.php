<div class="col-12">
    <div class="form-group">
        <dl class="row mb-3">
            {{--            label --}}
            <dt class="col-sm-2 text-dark">Certificate</dt>

            {{--            the value --}}
            <dd class="col-sm-10 lh-md">
                @if($userTrainingRecord->signature && $userTrainingRecord->signature->signature_image)
                    <div>
                        <a href="{{ route('certificates.certificatePdf', $training->id) }}" target="_blank"><i class="bi bi-download me-2"></i>Download</a>
                    </div>
                @elseif($userTrainingRecord->signature && $userTrainingRecord->signature->signed_certificate_image)
                    <div>
                        <a href="{{ uploads_url($userTrainingRecord->signature->signed_certificate_image) }}" target="_blank"><i class="bi bi-download me-2"></i>Download</a>
                    </div>
                @else
                    <span class="text-muted">Certificate not yet available</span>
                @endif
            </dd>
        </dl>
    </div>
</div>

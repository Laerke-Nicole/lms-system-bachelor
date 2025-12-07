@props(['training'])

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

@extends('layouts.profile')

@section('profile-content')


    <h3>Contact</h3>
    <p class="mb-5">If you have any questions or need assistance, please feel free to reach out to us.</p>

    <div class="row">
{{--        phone --}}
        @if($ab_inventech->ab_inventech_phone)
            <div class="d-flex">
                <div>
                    <i class="bi bi-telephone text-primary me-4 fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Phone</h5>
                    <p>{{ $ab_inventech->ab_inventech_phone }}</p>
                </div>
            </div>
        @endif

{{--        email --}}
        @if($ab_inventech->ab_inventech_mail)
            <div class="d-flex">
                <div>
                    <i class="bi bi-envelope text-primary me-4 fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Mail</h5>
                    <p>{{ $ab_inventech->ab_inventech_mail }}</p>
                </div>
            </div>
        @endif

{{--        address --}}
        @if($ab_inventech)
            <div class="d-flex">
                <div>
                    <i class="bi bi-geo-alt text-primary me-4 fs-4"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Address</h5>
                    <p>{{ $ab_inventech->address->street_name }} {{ $ab_inventech->address->street_number }}
                        <br>{{ $ab_inventech->address->postalCode->postal_code }}, {{ $ab_inventech->address->postalCode->city }}, {{ $ab_inventech->address->postalCode->country }}</p>
                </div>
            </div>
        @endif
    </div>


@endsection

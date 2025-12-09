@extends('layouts.profile')

@section('profile-content')


    <h3>Contact</h3>
    <p class="mb-5">If you have any questions or need assistance, please feel free to reach out to us.</p>

    <div class="row">
{{--        phone --}}
        @if($ab_inventech->ab_inventech_phone)
            <x-blocks.detail field="Phone" title="{{ $ab_inventech->ab_inventech_phone }}">
                <div>
                    <i class="bi bi-telephone text-primary me-3 fs-4"></i>
                </div>
            </x-blocks.detail>
        @endif

{{--        email --}}
        @if($ab_inventech->ab_inventech_mail)
            <x-blocks.detail field="Mail" title="{{ $ab_inventech->ab_inventech_mail }}">
                <div>
                    <i class="bi bi-envelope text-primary me-3 fs-4"></i>
                </div>
            </x-blocks.detail>
        @endif

{{--        address --}}
        @if($ab_inventech)
            <x-blocks.show-address :table="$ab_inventech">
                <div>
                    <i class="bi bi-geo-alt text-primary me-3 fs-4"></i>
                </div>
            </x-blocks.show-address>
        @endif
    </div>


@endsection

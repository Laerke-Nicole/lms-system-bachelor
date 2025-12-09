@if($table->address)
    <x-blocks.detail field="Address"
                     title="{{ $table->address->street_name }} {{ $table->address->street_number }}"
                     secondTitle="{{ $table->address->postalCode?->postal_code }}, {{ $table->address->postalCode?->city }}"
                     thirdTitle="{{ $table->address->postalCode?->country }}">
        {{ $slot }}
    </x-blocks.detail>
@endif

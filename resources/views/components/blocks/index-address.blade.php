@if($table->address)
    {{ $table->address->street_name }} {{ $table->address->street_number }}
    @if($table->address->postalCode)
        <br>{{ $table->address->postalCode->postal_code }} {{ $table->address->postalCode->city }}
        <br>{{ $table->address->postalCode->country }}
    @endif
@endif

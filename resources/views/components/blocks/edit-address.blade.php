<x-elements.input label="Street Name" name="street_name" value="{{ $table->address->street_name }}"/>
<x-elements.input label="Street Number" name="street_number" value="{{ $table->address->street_number }}"/>
<x-elements.input label="Postal Code" name="postal_code" value="{{ $table->address->postalCode->postal_code }}"/>
<x-elements.input label="City" name="city" value="{{ $table->address->postalCode->city }}"/>
<x-elements.input label="Country" name="country" value="{{ $table->address->postalCode->country }}"/>

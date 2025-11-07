<x-elements.input col="col-12 col-lg-4" label="Street Name" name="street_name" value="{{ $table->address->street_name }}"/>
<x-elements.input col="col-12 col-lg-4" label="Street Number" name="street_number" value="{{ $table->address->street_number }}"/>
<x-elements.input col="col-12 col-lg-4" label="Postal Code" name="postal_code" value="{{ $table->address->postalCode->postal_code }}"/>
<x-elements.input col="col-12 col-lg-4" label="City" name="city" value="{{ $table->address->postalCode->city }}"/>
<x-elements.input col="col-12 col-lg-4" label="Country" name="country" value="{{ $table->address->postalCode->country }}"/>

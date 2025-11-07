<x-blocks.detail field="Street:" title="{{ optional($table)->address->street_name }} {{ optional($table)->address->street_number }}"></x-blocks.detail>
<x-blocks.detail field="Postal code:" title="{{ optional($table)->address->postalCode->postal_code }}"></x-blocks.detail>
<x-blocks.detail field="City:" title="{{ optional($table)->address->postalCode->city }}"></x-blocks.detail>
<x-blocks.detail field="Country:" title="{{ optional($table)->address->postalCode->country }}"></x-blocks.detail>

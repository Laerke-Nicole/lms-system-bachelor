<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Signature extends Pivot
{
    protected $table = 'signatures';

    protected $fillable = [
        'user_id',
        'evaluation_id',
        'is_signed',
        'signed_date',
    ];
}

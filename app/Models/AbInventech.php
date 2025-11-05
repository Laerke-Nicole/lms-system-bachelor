<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbInventech extends Model
{
    use HasFactory;

    protected $table = 'ab_inventech';

    protected $fillable = [
        'ab_inventech_name',
        'ab_inventech_web',
        'ab_inventech_mail',
        'ab_inventech_phone',
        'logo',
        'address_id',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}

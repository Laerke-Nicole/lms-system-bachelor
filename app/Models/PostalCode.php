<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'postal_code',
        'city',
        'country',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}

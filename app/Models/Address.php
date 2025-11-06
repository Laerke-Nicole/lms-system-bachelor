<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_name',
        'street_number',
        'postal_code_id',
    ];

    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function abInventech()
    {
        return $this->hasMany(AbInventech::class);
    }
}

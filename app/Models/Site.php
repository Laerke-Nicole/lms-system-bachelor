<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_mail',
        'site_phone',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

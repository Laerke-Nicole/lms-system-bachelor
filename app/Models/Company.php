<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_mail',
        'company_phone',
        'is_vestas',
        'address_id',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

//    get users through site
    public function users()
    {
        return $this->hasManyThrough(User::class, Site::class);
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'valid_until',
        'vestas_format',
        'url',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by_id');
    }
}

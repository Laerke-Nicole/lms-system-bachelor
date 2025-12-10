<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'training_id',
    ];

//    calculate the training_date plus 24 months till its not valid anymore
    public function getValidUntilAttribute()
    {
        return $this->training->trainingSlot->training_date->addMonths(24);
    }

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

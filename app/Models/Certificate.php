<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_user_id',
        'vestas_format',
    ];

//    calculate the training_date plus 24 months till its not valid anymore
    public function getValidUntilAttribute()
    {
        return $this->trainingUser->training->trainingSlot->training_date->addMonths(24);
    }

    public function trainingUser()
    {
        return $this->belongsTo(TrainingUser::class);
    }

    public function signature()
    {
        return $this->hasOne(Signature::class, 'certificate_id');
    }
}

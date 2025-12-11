<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingUser extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'training_id',
        'completed_evaluation_at',
        'assessment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function signature()
    {
        return $this->hasOne(Signature::class, 'training_user_id');
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class, 'training_user_id');
    }
}

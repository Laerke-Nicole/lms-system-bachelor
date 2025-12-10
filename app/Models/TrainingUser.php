<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingUser extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'training_id',
//        'completed_test_at',
        'completed_evaluation_at',
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
        return $this->hasOne(Signature::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
}

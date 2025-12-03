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
        'completed_test_at',
        'completed_evaluation_at',
        'signed_at',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingUser extends Pivot
{
    use HasFactory;

    protected $table = 'training_user';
    protected $fillable = ['user_id', 'training_id'];
}

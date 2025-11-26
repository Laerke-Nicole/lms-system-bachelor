<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'duration_months',
        'image',
    ];

    public function trainingSlots()
    {
        return $this->hasMany(TrainingSlot::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function followUpTests()
    {
        return $this->hasMany(FollowUpTest::class);
    }
}

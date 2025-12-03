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
        'max_participants',
        'image',
        'evaluation_id',
        'follow_up_test_id',
    ];

    public function trainingSlots()
    {
        return $this->hasMany(TrainingSlot::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function followUpTest()
    {
        return $this->belongsTo(FollowUpTest::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function courseMaterials()
    {
        return $this->hasMany(CourseMaterial::class);
    }

}

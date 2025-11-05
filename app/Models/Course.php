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
        'duration_months',
        'image',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class);
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

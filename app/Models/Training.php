<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'place',
        'status',
        'training_time',
        'training_date',
        'participation_link',
        'reminder_sent_18_m',
        'reminder_sent_22_m',
        'reminder_before_training',
        'extra_comments',
        'course_id',
        'created_by_id',
        'ordered_by_id',
        'trainer_id',
        'course_id',
        'user_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function orderedBy()
    {
        return $this->belongsTo(User::class, 'ordered_by_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}

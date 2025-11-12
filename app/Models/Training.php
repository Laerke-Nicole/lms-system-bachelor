<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'place',
        'status',
        'training_date',
        'participation_link',
        'reminder_sent_18_m',
        'reminder_sent_22_m',
        'reminder_before_training',
        'course_id',
        'created_by_id',
        'ordered_by_id',
        'trainer_id',
        'course_id',
        'user_id',
    ];

    protected $casts = [
        'training_date' => 'datetime:Y m d H:i',
        'reminder_before_training' => 'date:Y-m-d',
    ];

//    format of dates to not show 2025-01-12 but 01 dec 2025
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }

    public function getTrainingDateFormattedAttribute()
    {
        return $this->training_date ? $this->training_date->format('d M Y H:i') : null;
    }

    public function getReminderBeforeTrainingFormattedAttribute()
    {
        return $this->reminder_before_training ? $this->reminder_before_training->format('d M Y') : null;
    }

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

    public function certificates()
    {
        return $this->belongsToMany(Certificate::class)->withTimestamps();
    }
}

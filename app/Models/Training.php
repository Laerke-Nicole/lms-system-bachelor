<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'reminder_sent_18_m',
        'reminder_sent_22_m',
        'reminder_before_training',
        'ordered_by_id',
        'training_slot_id',
    ];

    protected $casts = [
        'reminder_before_training' => 'date:Y-m-d',
    ];

//    format of dates to not show 2025-01-12 but 01 dec 2025
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }

    public function getReminderBeforeTrainingFormattedAttribute()
    {
        return $this->reminder_before_training ? $this->reminder_before_training->format('d M Y') : null;
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function orderedBy()
    {
        return $this->belongsTo(User::class, 'ordered_by_id');
    }

    public function trainingSlot()
    {
        return $this->belongsTo(TrainingSlot::class);
    }

    public function getCourseAttribute()
    {
        return $this->trainingSlot?->course;
    }

    public function trainingUsers()
    {
        return $this->hasMany(TrainingUser::class);
    }

}

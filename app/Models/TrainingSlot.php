<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Prunable;

class TrainingSlot extends Model
{
    use HasFactory, Prunable;

    protected $fillable = [
        'training_date',
        'training_day',
        'place',
        'status',
        'participation_link',
        'course_id',
        'created_by_admin_id',
        'trainer_id',
    ];

    protected $casts = [
        'training_date' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (TrainingSlot $slot) {
            if ($slot->isDirty('training_date') && $slot->training_date) {
                $slot->training_day = Carbon::parse($slot->training_date)->toDateString();
            }
        });
    }

//    format of dates to not show 2025-01-12 but 01 dec 2025
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y H:i');
    }

    public function getDateTimeFormattedAttribute()
    {
        return $this->training_date ? $this->training_date->format('d M Y H:i') : null;
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function createdByAdmin()
    {
        return $this->belongsTo(User::class, 'created_by_admin_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function training()
    {
        return $this->hasOne(Training::class);
    }

    /**
     * 24 months after the training_date delete the training data
     */
    public function prunable(): Builder
    {
        return static::where('training_date', '<=', now()->subMonths(24));
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role',
        'leader_can_view_info',
        'site_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class)->withTimestamps();
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class)->withTimestamps();
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class, 'signature')
            ->using(Signature::class)
            ->withPivot('signed_date', 'is_signed')
            ->withTimestamps();
    }

    public function followUpTests()
    {
        return $this->belongsToMany(FollowUpTest::class, 'user_test_result')
            ->using(UserTestResult::class)
            ->withPivot('is_passed', 'complete_date')
            ->withTimestamps();
    }

    public function sentEmails()
    {
        return $this->hasMany(Email::class, 'sender_id');
    }

    public function receivedEmails()
    {
        return $this->hasMany(Email::class, 'recipient_id');
    }

    public function orderedTrainings()
    {
        return $this->hasMany(Training::class, 'ordered_by_id');
    }

    public function trainingSlotsAsTrainer()
    {
        return $this->hasMany(TrainingSlot::class, 'trainer_id');
    }

    public function createdTrainingSlots()
    {
        return $this->hasMany(TrainingSlot::class, 'created_by_admin_id');
    }

    public function verifiedCertificates()
    {
        return $this->hasMany(Training::class, 'verified_by_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}

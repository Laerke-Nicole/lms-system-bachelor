<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_link',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_test_result')
                    ->using(UserTestResult::class)
                    ->withPivot('signed_date', 'is_signed')
                    ->withTimestamps();
    }
}

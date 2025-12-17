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
}

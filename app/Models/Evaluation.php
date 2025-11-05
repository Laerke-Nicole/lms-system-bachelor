<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'evaluation_link',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'signature')
                    ->using(Signature::class)
                    ->withPivot('signed_date', 'is_signed')
                    ->withTimestamps();
    }

}

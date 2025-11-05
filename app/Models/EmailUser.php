<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailUser extends Pivot
{
    use HasFactory;

    protected $table = 'email_user';
    protected $fillable = ['user_id', 'email_id'];
}

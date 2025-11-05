<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTestResult extends Pivot
{
//    protected $table = 'user_test_result';

    protected $fillable = [
        'user_id',
        'follow_up_test_id',
        'is_passed',
        'completed_date',
    ];
}

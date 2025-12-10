<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'signature_image',
        'signed_certificate_pdf',
        'final_certificate_pdf',
        'signature_confirmed',
        'signed_at',
        'certificate_id',
        'training_user_id',
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

    public function trainingUser()
    {
        return $this->belongsTo(TrainingUser::class);
    }
}

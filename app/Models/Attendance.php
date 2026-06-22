<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'intern_id',
        'attendance_date',
        'check_in',
        'check_out',
        'status',
        'reason',
        'selfie_photo',
        'supporting_document'
    ];

    public function intern()
    {
        return $this->belongsTo(Intern::class);
    }
}
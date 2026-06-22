<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    protected $fillable = [
        'intern_code',
        'name',
        'email',
        'password',
        'phone',
        'institution',
        'major',
        'division',
        'mentor',
        'start_date',
        'end_date',
        'status'
    ];
    public function attendances()
{
    return $this->hasMany(Attendance::class);
}

}

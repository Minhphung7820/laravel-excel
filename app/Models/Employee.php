<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'full_name',
        'shift_id',
        'position_id',
        'department_id',
        'job_id',
    ];
}

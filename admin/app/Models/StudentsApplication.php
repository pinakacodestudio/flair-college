<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentsApplication extends Model
{
    use SoftDeletes;

    protected $table = 'students_applications';

    protected $guarded = ['id'];

    protected $dates = ['dob'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

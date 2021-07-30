<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CollegeStaff extends Model
{
    use SoftDeletes;

    protected $table = 'college_staff';

    protected $guarded = ['id'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

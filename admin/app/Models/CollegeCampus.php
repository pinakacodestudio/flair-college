<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CollegeCampus extends Model
{
    use SoftDeletes;

    protected $table = 'college_campus';

    protected $guarded = ['id'];

    public function staff()
    {
        return $this->belongsTo(CollegeStaff::class, 'staff_id');
    }
}

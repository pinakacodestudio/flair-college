<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use SoftDeletes;

    protected $table = 'colleges';

    protected $guarded = ['id'];
}

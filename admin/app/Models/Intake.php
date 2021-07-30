<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    use SoftDeletes;

    protected $table = 'intakes';

    protected $guarded = ['id'];

    protected $dates = ['start_date'];
}

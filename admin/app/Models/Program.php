<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use SoftDeletes;

    protected $table = 'programs';

    protected $guarded = ['id'];
}

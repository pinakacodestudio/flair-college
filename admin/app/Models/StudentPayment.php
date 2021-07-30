<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use SoftDeletes;

    protected $table = 'student_payments';

    protected $guarded = ['id'];
    protected $dates = ['payment_at'];

    public function student_admission()
    {
        return $this->belongsTo(StudentAdmission::class);
    }
}

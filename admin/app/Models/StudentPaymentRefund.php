<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentPaymentRefund extends Model
{
    use SoftDeletes;

    protected $table = 'student_payment_refunds';

    protected $guarded = ['id'];
    protected $dates = ['refund_at'];

    public function student_admission()
    {
        return $this->belongsTo(StudentAdmission::class);
    }
}

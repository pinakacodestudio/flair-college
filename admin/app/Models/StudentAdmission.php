<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class StudentAdmission extends Model
{
    use SoftDeletes;

    protected $table = 'student_admissions';

    protected $guarded = ['id'];

    protected $dates = ['start_at', 'completion_at', 'expiration_at'];

    public function students_application()
    {
        return $this->belongsTo(StudentsApplication::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function intake()
    {
        return $this->belongsTo(Intake::class);
    }
}

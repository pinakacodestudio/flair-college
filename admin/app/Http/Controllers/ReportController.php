<?php

namespace App\Http\Controllers;

use App\Models\StudentAdmission;
use App\Models\StudentPayment;
use App\Models\StudentPaymentRefund;
use Illuminate\Http\Request;

use Auth;


class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function reports(Request $request)
    {
        return view('reports');
    }

    public function reports_students(Request $request)
    {
        /**
         * Student
         * Program
         * Agent
         * Intake
         * LOA status
         * Export data
         */

        $student_admissions = StudentAdmission::where('status', 1)
            ->with(['students_application', 'program', 'intake'])
            ->get();

        //dd($student_admissions);
        return view('reports.students', compact('student_admissions'));
    }

    public function reports_fees(Request $request)
    {
        /**
         * Student
         * Application no
         * Agent
         * Intake
         * Course
         * Fees ref. no
         * Fees amount
         * Refund ref. no
         * Refund amount
         */

        $student_payments = StudentPayment::where('status', 1)
            ->with('student_admission.students_application')
            ->get();

        $student_payments->each(function ($student_payment) {
            //dump($student_payment);
        });

        //dd();
        return view('reports.fees', compact('student_payments'));
    }

    public function reports_refunds(Request $request)
    {
        /**
         * Student
         * Application no
         * Agent
         * Intake
         * Course
         * Fees ref. no
         * Fees amount
         * Refund ref. no
         * Refund amount
         */

        $student_payment_refunds = StudentPaymentRefund::where('status', 1)
            ->with('student_admission.students_application')
            ->get();

        $student_payment_refunds->each(function ($student_payment) {
            //dump($student_payment);
        });

        //dd();
        return view('reports.refunds', compact('student_payment_refunds'));
    }
}

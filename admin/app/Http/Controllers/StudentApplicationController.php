<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\College;
use App\Models\CollegeCampus;
use App\Models\CollegeStaff;
use App\Models\Intake;
use App\Models\Program;
use App\Models\StudentAdmission;
use App\Models\StudentPayment;
use App\Models\StudentPaymentRefund;
use App\Models\StudentsApplication;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use Auth;
use Validator;
use PDF;

class StudentApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['setInvitationPassword', 'saveInvitationPassword']]);
    }

    public function index()
    {
        $students_applications = StudentsApplication::all();

        $students_applications->each(function ($students_application) {
            $programs_ids = $students_application->programs_ids;
            $programs_ids_array = explode(',', $programs_ids);
            $programs = Program::whereIn('id', $programs_ids_array)->pluck('name')->toArray();
            $students_application->program_interested_in = $programs;
            return $students_application;
        });
        //dd($students_applications);
        return view('applications.index', compact('students_applications'));
    }

    public function view(Request $request, $id)
    {
        $college_id = config('app.college_id');
        $staff_position = config('app.staff_position');

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {
            $college = College::where('id', $college_id)->first();

            $programs_ids = explode(',', $students_application->programs_ids);
            $intake_ids = explode(',', $students_application->intake_ids);

            $programs = Program::where('status', 1)->get();
            $intakes = Intake::where('status', 1)->pluck('name', 'id');

            $updated_user = User::find($students_application->updated_user_id);

            $student_id_number = '';

            $current_intakes = [];

            $program = null;
            $intake = null;
            $student_admission = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();
            if ($student_admission) {
                $program = Program::find($student_admission->program_id);
                $intake = Intake::find($student_admission->intake_id);

                $start_at = $student_admission->start_at ? $student_admission->start_at->format('ym') : '';

                $student_id_number = sprintf('%02d', $college->id) . '' . $start_at . '' . sprintf('%03d', $student_admission->id);

                $intake_ids_array = explode(',', $program->intake_ids);
                if (is_array($intake_ids_array) && count($intake_ids_array)) {
                    $current_intakes = Intake::where('status', 1)
                        ->whereIn('id', $intake_ids_array)
                        ->get();
                }

                //dd($program);
                //dd($student_admission->program_id);
            }

            $level_of_study = config('app.level_of_study');
            $type_of_program = config('app.type_of_program');
            $academic_status = config('app.academic_status');

            //dd($level_of_study);

            $expiration_at = Carbon::now()->addWeek(2);

            $college_staffs = CollegeStaff::where('college_id', $college_id)
                ->where('status', 1)
                ->get();

            $college_campus = CollegeCampus::where('college_id', $college_id)
                ->where('status', 1)
                ->get();

            return view('applications.view', compact('students_application', 'programs', 'intakes', 'programs_ids', 'intake_ids', 'updated_user', 'student_admission', 'program', 'intake', 'level_of_study', 'type_of_program', 'academic_status', 'expiration_at', 'student_id_number', 'current_intakes', 'college_staffs', 'college_campus', 'staff_position'));
        }
        return redirect(route('applications'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $auth_user = Auth::user();
        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $last_name = $request->input('last_name');
            $first_name = $request->input('first_name');
            $middle_name = $request->input('middle_name');
            $email = $request->input('email');
            $country_of_citizenship = $request->input('country_of_citizenship');
            $passport_number = $request->input('passport_number');
            $gender = $request->input('gender');
            $dob = $request->input('dob');
            $home_address = $request->input('home_address');
            $home_postcode = $request->input('home_postcode');
            $home_country = $request->input('home_country');
            $home_phone = $request->input('home_phone');
            $secondary_address = $request->input('secondary_address');
            $secondary_city = $request->input('secondary_city');
            $secondary_postcode = $request->input('secondary_postcode');
            $secondary_province = $request->input('secondary_province');
            $secondary_phone = $request->input('secondary_phone');
            $is_agent = $request->input('is_agent', 0);
            $agent_name = $request->input('agent_name');
            $academic_qualification_name = $request->input('academic_qualification_name');
            $academic_qualification_year = $request->input('academic_qualification_year');
            $is_english_first_language = $request->input('is_english_first_language');
            $is_english_test_given = $request->input('is_english_test_given');
            $english_test_name = $request->input('english_test_name');
            $english_test_score = $request->input('english_test_score');
            $english_test_date = $request->input('english_test_date');
            $programs = $request->input('programs');
            $intakes = $request->input('intakes');
            $i_agreed = $request->input('i_agreed');

            if ($students_application->admission_status != Constant::ADMISSION_STATUS_FINAL_LOA) {
                if (count($programs) == 0) {
                    return response()->json(['error' => 1, 'message' => 'Select at least one Post Secondary Program']);
                } elseif (count($intakes) == 0) {
                    return response()->json(['error' => 1, 'message' => 'Select at least one Intake you are interested in']);
                }
            }

            $students_application_data = [
                'last_name'                   => $last_name,
                'first_name'                  => $first_name,
                'middle_name'                 => $middle_name,
                'email'                       => $email,
                'country_of_citizenship'      => $country_of_citizenship,
                'passport_number'             => $passport_number,
                'gender'                      => $gender,
                'dob'                         => (!is_null($dob) ? Carbon::parse($dob) : ''),
                'home_address'                => $home_address,
                'home_postcode'               => $home_postcode,
                'home_country'                => $home_country,
                'home_phone'                  => $home_phone,
                'secondary_address'           => $secondary_address,
                'secondary_city'              => $secondary_city,
                'secondary_postcode'          => $secondary_postcode,
                'secondary_province'          => $secondary_province,
                'secondary_phone'             => $secondary_phone,
                'is_agent'                    => $is_agent,
                'agent_name'                  => $agent_name,
                'academic_qualification_name' => $academic_qualification_name,
                'academic_qualification_year' => $academic_qualification_year,
                'is_english_first_language'   => $is_english_first_language,
                'is_english_test_given'       => $is_english_test_given,
                'english_test_name'           => $english_test_name,
                'english_test_score'          => $english_test_score,
                'english_test_date'           => (!is_null($english_test_date) ? Carbon::parse($english_test_date) : ''),
                //'programs_ids'                => implode(',', $programs),
                //'intake_ids'                  => implode(',', $intakes),
                //'admission_status'            => 1,
                'updated_user_id'             => $auth_user->id,
            ];

            if ($students_application->admission_status != Constant::ADMISSION_STATUS_FINAL_LOA) {
                $students_application_data['programs_ids'] = implode(',', $programs);
                $students_application_data['intake_ids'] = implode(',', $intakes);
            }

            $students_application->update($students_application_data);

            return response()->json(['error' => 0, 'message' => 'Success', 'id' => $students_application->id]);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Application detail']);
    }

    public function generate_conditional_loa(Request $request, $id)
    {
        $auth_user = Auth::user();

        //dd($request->all());

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $program_id = $request->input('program_id');
            $intake_id = $request->input('intake_id');
            if (empty($program_id)) {
                return response()->json(['error' => 1, 'message' => 'First select any program']);
            }
            if (empty($intake_id)) {
                return response()->json(['error' => 1, 'message' => 'First select any intake']);
            }

            $program = Program::find($program_id);
            $intake = Intake::find($intake_id);
            if (!$program || !$intake) {
                return response()->json(['error' => 1, 'message' => 'Invalid program or intake selected']);
            }

            $student_admissions = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            if ($student_admissions) {
                return response()->json(['error' => 1, 'message' => 'Students Application already register']);
            } else {

                $level_of_study_config = config('app.level_of_study');
                $type_of_program_config = config('app.type_of_program');
                $academic_status_config = config('app.academic_status');

                $type_of_program = isset($type_of_program_config[$program->type_of_program]) ? $type_of_program_config[$program->type_of_program] : $program->type_of_program;

                if ($program->type_of_program == 'other') {
                    $type_of_program = $program->type_of_program_other;
                }

                $level_of_study = isset($level_of_study_config[$program->level_of_study]) ? $level_of_study_config[$program->level_of_study] : $program->level_of_study;
                $academic_status = isset($academic_status_config[$program->academic_status]) ? $academic_status_config[$program->academic_status] : $program->academic_status;

                $program_duration_weeks = $program->program_duration_weeks;
                $program_duration_years = $program->program_duration_years;
                $start_date = $intake->start_date;

                $program_end_date = '';
                if ($program_duration_weeks != '') {
                    $program_end_date = $start_date->addWeeks($program_duration_weeks);//->format('Y-m-d');
                } else if ($program_duration_years != '') {
                    $program_end_date = $start_date->addYears($program_duration_years);//->format('Y-m-d');
                }

                //$expiration_at = Carbon::now()->addWeek(2);

                $request_data = [
                    'students_application_id' => $students_application->id,
                    'user_id'                 => $auth_user->id,
                    //'student_id_number'        => '',
                    'program_id'              => $program_id,
                    'intake_id'               => $intake_id,

                    //'first_year_fees' => '',

                    'level_of_study'  => $level_of_study,
                    'type_of_program' => $type_of_program,
                    'academic_status' => $academic_status,
                    'hours_per_week'  => $program->hours_per_week,

                    //'fees_prepaid'             => '',
                    //'is_scholarship'           => '',
                    //'scholarship'              => '',
                    //'is_internship'            => '',
                    //'internship_length'        => '',
                    //'internship_work'          => '',
                    //'conditions_of_acceptance' => '',

                    'start_at'      => $intake->start_date,
                    'completion_at' => $program_end_date,
                    //'expiration_at' => $expiration_at,

                    //'other_information' => '',
                ];

                $student_admissions = StudentAdmission::create($request_data);

                $students_application->admission_status = Constant::ADMISSION_STATUS_CONDITIONAL_LOA;
                $students_application->save();
            }

            return response()->json(['error' => 0, 'message' => 'Success', 'application_no' => $students_application->application_no, 'student_admissions_id' => $student_admissions->id]);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Application detail']);
    }

    public function verify_conditional_loa(Request $request, $id)
    {
        $auth_user = Auth::user();

        $validator = Validator::make($request->all(), [
            'signed_conditional_loa' => 'required|mimes:pdf|max:10240',
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'error'   => 1,
                    'message' => $validator->errors()->first()
                ]);
        }

        //dd($request->all());

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $student_admission = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            if ($student_admission) {
                if ($request->hasFile('signed_conditional_loa')) {
                    $signed_conditional_loa = $request->file('signed_conditional_loa');

                    $filename = $students_application->application_no . "_signed_loa." . $signed_conditional_loa->getClientOriginalExtension();

                    $signed_conditional_loa->storeAs(Constant::SIGNED_LOA_FOLDER, $filename);

                    $student_admission->signed_loa_filename = $filename;
                    $student_admission->status = 1;
                    $student_admission->save();


                    $students_application->admission_status = Constant::ADMISSION_STATUS_PENDING_FINAL_LOA;
                    $students_application->save();
                } else {
                    return response()->json(['error' => 1, 'message' => 'Invalid conditional LOA file.']);
                }
            } else {
                return response()->json(['error' => 1, 'message' => 'Students Application not found']);
            }

            return response()->json(['error' => 0, 'message' => 'Success', 'application_no' => $students_application->application_no, 'student_admission_id' => $student_admission->id]);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Application detail']);
    }

    public function download_conditional_loa(Request $request, $id)
    {
        $auth_user = Auth::user();

        //dd($request->all());

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $student_admission = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            if ($student_admission) {
                $program = Program::find($student_admission->program_id);

                $download = $request->input('download', 1);

                if ($download) {
                    $pdf = PDF::loadView('applications.conditional_loa_pdf', compact('student_admission', 'students_application', 'program', 'auth_user'));

                    return $pdf->download('CONDITIONAL LOA #' . $students_application->application_no . '.pdf');
                } else {
                    return view('applications.conditional_loa_pdf', compact('student_admission', 'students_application', 'program', 'auth_user'));
                }
            }
        }
        return redirect(route('applications'));
    }

    public function download_signed_conditional_loa(Request $request, $id)
    {
        $auth_user = Auth::user();

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $student_admission = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            if ($student_admission) {
                try {
                    $signed_conditional_loa = storage_path('app' . DIRECTORY_SEPARATOR . Constant::SIGNED_LOA_FOLDER . DIRECTORY_SEPARATOR . $student_admission->signed_loa_filename);

                    return response()->download($signed_conditional_loa);
                } catch (Exception $e) {
                    return redirect()->back()->withErrors(['Invalid signed conditional LOA file. ' . $e->getMessage()]);
                }
            }
        }
        return redirect(route('applications'));
    }

    public function generate_final_loa(Request $request, $id)
    {
        $auth_user = Auth::user();

        //dd($request->all());

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $program_id = $request->input('program_id');
            $intake_id = $request->input('intake_id');
            if (empty($program_id)) {
                return response()->json(['error' => 1, 'message' => 'First select any program']);
            }
            if (empty($intake_id)) {
                return response()->json(['error' => 1, 'message' => 'First select any intake']);
            }

            $program = Program::find($program_id);
            $intake = Intake::find($intake_id);
            if (!$program || !$intake) {
                return response()->json(['error' => 1, 'message' => 'Invalid program or intake selected']);
            }

            $student_admissions = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            $student_id_number = $request->input('student_id_number');
            $first_year_fees = $request->input('first_year_fees');
            $fees_prepaid = $request->input('fees_prepaid');
            $exchange_program = $request->input('exchange_program');
            $is_scholarship = $request->input('is_scholarship');
            $scholarship = $request->input('scholarship');
            $is_internship = $request->input('is_internship');
            $internship_length = $request->input('internship_length');
            $internship_work = $request->input('internship_work');
            $conditions_of_acceptance = $request->input('conditions_of_acceptance');
            $expiration_at = $request->input('expiration_at');
            $other_information = $request->input('other_information');

            $staff1_id = $request->input('staff1_id');
            $staff2_id = $request->input('staff2_id');

            $college_campus_id = $request->input('college_campus_id'); // new added 27-02-21

            if ($student_admissions) {
                ///////////////////////////////////
                $level_of_study_config = config('app.level_of_study');
                $type_of_program_config = config('app.type_of_program');
                $academic_status_config = config('app.academic_status');

                $type_of_program = isset($type_of_program_config[$program->type_of_program]) ? $type_of_program_config[$program->type_of_program] : $program->type_of_program;

                if ($program->type_of_program == 'other') {
                    $type_of_program = $program->type_of_program_other;
                }

                $level_of_study = isset($level_of_study_config[$program->level_of_study]) ? $level_of_study_config[$program->level_of_study] : $program->level_of_study;
                $academic_status = isset($academic_status_config[$program->academic_status]) ? $academic_status_config[$program->academic_status] : $program->academic_status;

                $program_duration_weeks = $program->program_duration_weeks;
                $program_duration_years = $program->program_duration_years;
                $start_date = $intake->start_date;

                $program_end_date = '';
                if ($program_duration_weeks != '') {
                    $program_end_date = $start_date->addWeeks($program_duration_weeks);//->format('Y-m-d');
                } else if ($program_duration_years != '') {
                    $program_end_date = $start_date->addYears($program_duration_years);//->format('Y-m-d');
                }

                //$expiration_at = Carbon::now()->addWeek(2);

                $request_data = [
                    'students_application_id' => $students_application->id,
                    'user_id'                 => $auth_user->id,

                    //'expiration_at' => $expiration_at,

                    //'other_information' => '',
                ];


                ///////////////////////////////////
                $student_admissions_data = [
                    'student_id_number'        => $student_id_number,
                    'first_year_fees'          => $first_year_fees,
                    'fees_prepaid'             => $fees_prepaid,
                    'exchange_program'         => $exchange_program,
                    'is_scholarship'           => $is_scholarship,
                    'scholarship'              => $scholarship,
                    'is_internship'            => $is_internship,
                    'internship_length'        => $internship_length,
                    'internship_work'          => $internship_work,
                    'conditions_of_acceptance' => $conditions_of_acceptance,
                    'expiration_at'            => (!is_null($expiration_at) ? Carbon::parse($expiration_at) : ''),
                    'other_information'        => $other_information,

                    // if program/intake will change when final LOA generate
                    'program_id'               => $program_id,
                    'intake_id'                => $intake_id,
                    'level_of_study'           => $level_of_study,
                    'type_of_program'          => $type_of_program,
                    'academic_status'          => $academic_status,
                    'hours_per_week'           => $program->hours_per_week,
                    'start_at'                 => $intake->start_date,
                    'completion_at'            => $program_end_date,

                    'staff1_id' => $staff1_id,
                    'staff2_id' => $staff2_id,

                    'college_campus_id' => $college_campus_id,

                ];
                $student_admissions->update($student_admissions_data);

                $students_application->admission_status = Constant::ADMISSION_STATUS_FINAL_LOA;
                $students_application->save();

                return response()->json(['error' => 0, 'message' => 'Success', 'id' => $students_application->id]);
            } else {
                return response()->json(['error' => 1, 'message' => 'Invalid Application detail']);
            }
        }
        return response()->json(['error' => 1, 'message' => 'Invalid student admission detail']);
    }

    public function download_final_loa(Request $request, $id)
    {
        $auth_user = Auth::user();

        //dd($request->all());
        $college_id = config('app.college_id');
        $staff_position = config('app.staff_position');

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $student_admission = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            if ($student_admission) {
                $program = Program::find($student_admission->program_id);

                $staff1 = CollegeStaff::find($student_admission->staff1_id);
                $staff2 = CollegeStaff::find($student_admission->staff2_id);

                /* new 27-02-21 */
                $college_campus = CollegeCampus::find($student_admission->college_campus_id);
                if ($college_campus && $college_campus->staff) {
                    $staff1 = $college_campus->staff;
                }

                $college = College::where('id', $college_id)->first();

                $download = $request->input('download', 1);

                if ($download) {
                    $pdf = PDF::loadView('applications.final_loa_pdf', compact('student_admission', 'college', 'students_application', 'program', 'auth_user', 'staff_position', 'staff1', 'staff2', 'college_campus'));

                    //return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));

                    return $pdf->download('FINAL LOA #' . $students_application->application_no . '.pdf');
                } else {
                    return view('applications.final_loa_pdf', compact('student_admission', 'college', 'students_application', 'program', 'auth_user', 'staff_position', 'staff1', 'staff2', 'college_campus'));
                }
            }
        }
        return redirect(route('applications'));
    }

    function payments(Request $request, $id)
    {
        $auth_user = Auth::user();

        $college_id = config('app.college_id');
        $payment_modes = config('app.payment_modes');

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $student_admission = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            if ($student_admission) {

                $student_payment = StudentPayment::where('student_admission_id', $student_admission->id)->get();
                return view('applications.payments', compact('student_admission', 'students_application', 'auth_user', 'student_payment', 'payment_modes'));
            }
        }
        return redirect(route('applications.view', ['id' => $id]));
    }

    public function payment_delete(Request $request, $id)
    {
        $student_payment = StudentPayment::where('id', $id)->first();
        if ($student_payment) {
            $student_payment->delete();
            return response()->json(['error' => 0, 'message' => 'Success']);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Action']);
    }

    function refunds(Request $request, $id)
    {
        $auth_user = Auth::user();

        $college_id = config('app.college_id');
        $payment_modes = config('app.payment_modes');

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $student_admission = StudentAdmission::where('students_application_id', $students_application->id)
                ->first();

            if ($student_admission) {
                $payment_id = $request->input('payment_id');
                $payment = null;
                if ($payment_id > 0) {
                    $payment = StudentPayment::where('id', $payment_id)
                        ->where('student_admission_id', $student_admission->id)
                        ->first();
                    if (!$payment) {
                        session()->flash('error', 'Payment detail not found.');
                        return redirect(route('applications.payments', ['id' => $students_application->id]));
                    }
                }

                $student_payment_refund = StudentPaymentRefund::where('student_admission_id', $student_admission->id)->get();
                return view('applications.refunds', compact('student_admission', 'students_application', 'auth_user', 'student_payment_refund', 'payment_modes', 'payment'));
            }
        }
        return redirect(route('applications.view', ['id' => $id]));
    }

    public function refund_delete(Request $request, $id)
    {
        $student_payment_refund = StudentPaymentRefund::where('id', $id)->first();
        if ($student_payment_refund) {
            $student_payment_refund->delete();
            return response()->json(['error' => 0, 'message' => 'Success']);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Action']);
    }

}

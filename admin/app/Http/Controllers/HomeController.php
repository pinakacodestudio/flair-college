<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\College;
use App\Models\CollegeCampus;
use App\Models\CollegeStaff;
use App\Models\Intake;
use App\Models\Program;
use App\Models\StudentPayment;
use App\Models\StudentPaymentRefund;
use App\Models\StudentsApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use DB;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function dashboard()
    {
        $auth_user = $this->authUser;

        $total_application = StudentsApplication::where('admission_status', '!=', Constant::ADMISSION_STATUS_DECLINE)->count();
        $new_application = StudentsApplication::where('admission_status', Constant::ADMISSION_STATUS_PENDING)->count();

        $final_loa = 0;
        $pending_loa = 0;

        return view('dashboard', compact('total_application', 'new_application', 'final_loa', 'pending_loa'));
    }

    public function profile()
    {
        $user = $this->authUser;
        return view('profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $auth_user = $this->authUser;

        $user = User::where('id', $auth_user->id)->first();

        if ($user) {
            $validation_rules = [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($auth_user->id),
                ],
                /*'mobile'     => 'required',
                'address'    => 'required',
                'city'       => 'required',
                'country'    => 'required',*/
            ];

            $this->validate($request, $validation_rules); //, $messages

            $user_date = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'status' => ($request->has('status') ? 1 : 0),
            ];

            $user->update($user_date);

            session()->flash('success', 'Profile updated successfully.');

            return redirect(route('profile'));
        }
        return redirect('/');
    }

    public function ajax(Request $request, $action)
    {
        $auth_user = Auth::user();

        switch ($action) {
            default:

                return response()->json(['error' => 1, 'message' => 'Invalid Action']);
                break;

            case 'create_intake':
                $name = $request->input('name');
                $start_date = $request->input('start_date');
                if (empty($name)) {
                    return response()->json(['error' => 1, 'message' => 'Enter intake name.']);
                }
                if (empty($start_date)) {
                    return response()->json(['error' => 1, 'message' => 'Select intake start date.']);
                }
                $intake = Intake::where('name', $name)->first();
                if (!$intake) {
                    $intake = Intake::create(['name' => $name, 'start_date' => Carbon::parse($start_date), 'status' => 1]);
                    return response()->json(['error' => 0, 'message' => 'Intake created.', 'id' => $intake->id]);
                } else {
                    return response()->json(['error' => 1, 'message' => 'Intake already created.']);
                }
                break;

            case 'edit_intake':
                $id = $request->input('id');
                $name = $request->input('name');
                $start_date = $request->input('start_date');
                if (empty($name)) {
                    return response()->json(['error' => 1, 'message' => 'Enter intake name.']);
                }
                if (empty($start_date)) {
                    return response()->json(['error' => 1, 'message' => 'Select intake start date.']);
                }
                $intake = Intake::find($id);
                if ($intake) {
                    $intake->name = $name;
                    $intake->start_date = Carbon::parse($start_date);
                    $intake->save();
                    return response()->json(['error' => 0, 'message' => 'Intake updated.']);
                } else {
                    return response()->json(['error' => 1, 'message' => 'Intake not found.']);
                }

            case 'get_program_intake':
                $program_id = $request->input('program_id');
                $intake_id = $request->input('intake_id');
                if (empty($program_id)) {
                    return response()->json(['error' => 1, 'message' => 'First select any program']);
                }
                $program = Program::find($program_id);
                if ($program) {
                    $level_of_study_config = config('app.level_of_study');
                    $type_of_program_config = config('app.type_of_program');
                    $academic_status_config = config('app.academic_status');

                    $type_of_program = isset($type_of_program_config[$program->type_of_program]) ? $type_of_program_config[$program->type_of_program] : $program->type_of_program;
                    if ($program->type_of_program == 'other') {
                        $type_of_program = $program->type_of_program_other;
                    }

                    $program->type_of_program = $type_of_program;

                    $program->level_of_study = isset($level_of_study_config[$program->level_of_study]) ? $level_of_study_config[$program->level_of_study] : $program->level_of_study;
                    $program->academic_status = isset($academic_status_config[$program->academic_status]) ? $academic_status_config[$program->academic_status] : $program->academic_status;

                    $program->program_start_date = '-';
                    $program->program_end_date = '-';

                    $program->intake_name = '-';

                    $intake_ids = explode(',', $program->intake_ids);

                    //dd($intake_ids);

                    $intakes = Intake::whereIn('id', $intake_ids)->get();

                    if (!empty($intake_id)) {
                        $intake = Intake::find($intake_id);
                        if ($intake) {
                            $program_duration_weeks = $program->program_duration_weeks;
                            $program_duration_years = $program->program_duration_years;
                            $start_date = $intake->start_date;

                            $program_start_date = $start_date->format('Y-m-d');
                            $program_end_date = '';
                            $program_duration = '';
                            if ($program_duration_weeks != '') {
                                $program_duration = $program_duration_weeks . ' Week/s';
                                $program_end_date = $start_date->addWeeks($program_duration_weeks)->format('Y-m-d');
                            } else if ($program_duration_years != '') {
                                $program_duration = $program_duration_years . ' Year/s';
                                $program_end_date = $start_date->addYears($program_duration_years)->format('Y-m-d');
                            }

                            $program->program_start_date = $program_start_date;
                            $program->program_end_date = $program_end_date;
                            $program->program_duration = $program_duration;

                            $program->intake_name = $intake->name;
                        }
                    }

                    return response()->json(['error' => 0, 'program' => $program, 'intakes' => $intakes]);
                } else {
                    return response()->json(['error' => 1, 'message' => 'Program not found.']);
                }
                break;

            case 'decline_application':
                $id = $request->input('id');

                $students_application = StudentsApplication::where('id', $id)->first();
                if ($students_application) {

                    $students_application->admission_status = Constant::ADMISSION_STATUS_DECLINE;
                    $students_application->update();

                    return response()->json(['error' => 0, 'message' => 'Application created.', 'id' => $students_application->id]);
                } else {
                    return response()->json(['error' => 1, 'message' => 'Application not found.']);
                }
                break;

            case 'create_payment':
                $student_admission_id = $request->input('student_admission_id');
                $amount = $request->input('amount');
                $payment_mode = $request->input('payment_mode');
                $reference_no = $request->input('reference_no');
                $payment_at = $request->input('payment_at');
                $note = $request->input('note');

                if (empty($amount)) {
                    return response()->json(['error' => 1, 'message' => 'Enter amount.']);
                }
                if (empty($payment_mode)) {
                    return response()->json(['error' => 1, 'message' => 'Select payment mode.']);
                }
                if (empty($reference_no)) {
                    return response()->json(['error' => 1, 'message' => 'Enter reference no.']);
                }
                if (empty($payment_at)) {
                    return response()->json(['error' => 1, 'message' => 'Select payment date.']);
                }

                $student_payment = StudentPayment::create([
                    'student_admission_id' => $student_admission_id,
                    'amount' => $amount,
                    'payment_mode' => $payment_mode,
                    'reference_no' => $reference_no,
                    'payment_at' => Carbon::parse($payment_at),
                    'note' => $note,
                    'status' => 1
                ]);
                return response()->json(['error' => 0, 'message' => 'Payment created.', 'id' => $student_payment->id]);
                break;

            case 'edit_payment':
                $id = $request->input('id');
                $student_admission_id = $request->input('student_admission_id');
                $amount = $request->input('amount');
                $payment_mode = $request->input('payment_mode');
                $reference_no = $request->input('reference_no');
                $payment_at = $request->input('payment_at');
                $note = $request->input('note');

                if (empty($amount)) {
                    return response()->json(['error' => 1, 'message' => 'Enter amount.']);
                }
                if (empty($payment_mode)) {
                    return response()->json(['error' => 1, 'message' => 'Select payment mode.']);
                }
                if (empty($reference_no)) {
                    return response()->json(['error' => 1, 'message' => 'Enter reference no.']);
                }
                if (empty($payment_at)) {
                    return response()->json(['error' => 1, 'message' => 'Select payment date.']);
                }

                $student_payment = StudentPayment::find($id);
                if ($student_payment) {
                    $student_payment->update([
                        'amount' => $amount,
                        'payment_mode' => $payment_mode,
                        'reference_no' => $reference_no,
                        'payment_at' => Carbon::parse($payment_at),
                        'note' => $note
                    ]);

                } else {
                    return response()->json(['error' => 1, 'message' => 'Intake not found.']);
                }
                return response()->json(['error' => 0, 'message' => 'Payment created.', 'id' => $student_payment->id]);
                break;


            case 'create_payment_refund':
                $student_admission_id = $request->input('student_admission_id');
                $amount = $request->input('amount');
                $payment_mode = $request->input('payment_mode');
                $reference_no = $request->input('reference_no');
                $refund_at = $request->input('refund_at');
                $note = $request->input('note');

                if (empty($amount)) {
                    return response()->json(['error' => 1, 'message' => 'Enter amount.']);
                }
                if (empty($payment_mode)) {
                    return response()->json(['error' => 1, 'message' => 'Select refund mode.']);
                }
                if (empty($reference_no)) {
                    return response()->json(['error' => 1, 'message' => 'Enter reference no.']);
                }
                if (empty($refund_at)) {
                    return response()->json(['error' => 1, 'message' => 'Select refund date.']);
                }

                $student_payment_refund = StudentPaymentRefund::create([
                    'student_admission_id' => $student_admission_id,
                    'amount' => $amount,
                    'payment_mode' => $payment_mode,
                    'reference_no' => $reference_no,
                    'refund_at' => Carbon::parse($refund_at),
                    'note' => $note,
                    'status' => 1
                ]);
                return response()->json(['error' => 0, 'message' => 'Payment created.', 'id' => $student_payment_refund->id]);
                break;

            case 'edit_payment_refund':
                $id = $request->input('id');
                $student_admission_id = $request->input('student_admission_id');
                $amount = $request->input('amount');
                $payment_mode = $request->input('payment_mode');
                $reference_no = $request->input('reference_no');
                $refund_at = $request->input('refund_at');
                $note = $request->input('note');

                if (empty($amount)) {
                    return response()->json(['error' => 1, 'message' => 'Enter amount.']);
                }
                if (empty($payment_mode)) {
                    return response()->json(['error' => 1, 'message' => 'Select refund mode.']);
                }
                if (empty($reference_no)) {
                    return response()->json(['error' => 1, 'message' => 'Enter reference no.']);
                }
                if (empty($refund_at)) {
                    return response()->json(['error' => 1, 'message' => 'Select refund date.']);
                }

                $student_payment_refund = StudentPaymentRefund::find($id);
                if ($student_payment_refund) {
                    $student_payment_refund->update([
                        'amount' => $amount,
                        'payment_mode' => $payment_mode,
                        'reference_no' => $reference_no,
                        'refund_at' => Carbon::parse($refund_at),
                        'note' => $note
                    ]);

                } else {
                    return response()->json(['error' => 1, 'message' => 'Intake not found.']);
                }
                return response()->json(['error' => 0, 'message' => 'Payment created.', 'id' => $student_payment_refund->id]);
                break;
        }
    }

    public function ajax_status(Request $request, $action, $id, $type)
    {
        $auth_user = Auth::user();
        $status = ($type == 'active' ? 1 : 0);
        switch ($action) {
            default:
                break;

            case 'user':
                $table = User::userOnly()->where('id', $id)->first();
                if ($table) {
                    $table->status = $status;
                    $table->save();
                    return response()->json(['error' => 0, 'message' => 'User status successfully updated.']);
                }
                break;

            case 'sub_agent':
                $table = User::subAgentOnly()->where('id', $id)->first();
                if ($table) {
                    $table->status = $status;
                    $table->save();
                    return response()->json(['error' => 0, 'message' => 'Sub Agent status successfully updated.']);
                }
                break;

            case 'intake':
                $table = Intake::find($id);
                if ($table) {
                    $table->status = $status;
                    $table->save();
                    return response()->json(['error' => 0, 'message' => 'Intake status successfully updated.']);
                }
                break;

            case 'program':
                $table = Program::find($id);
                if ($table) {
                    $table->status = $status;
                    $table->save();
                    return response()->json(['error' => 0, 'message' => 'Program status successfully updated.']);
                }
                break;

            case 'staff':
                $table = CollegeStaff::find($id);
                if ($table) {
                    $table->status = $status;
                    $table->save();
                    return response()->json(['error' => 0, 'message' => 'College staff status successfully updated.']);
                }
                break;

            case 'campus':
                $table = CollegeCampus::find($id);
                if ($table) {
                    $table->status = $status;
                    $table->save();
                    return response()->json(['error' => 0, 'message' => 'College campus status successfully updated.']);
                }
                break;


        }

        return response()->json(['error' => 1, 'message' => 'Invalid Action', 'action' => $action, 'id' => $id, 'type' => $type]);
    }
}

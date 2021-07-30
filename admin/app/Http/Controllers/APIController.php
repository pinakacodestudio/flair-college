<?php

namespace App\Http\Controllers;


use App\Helpers\Constant;
use App\Mail\StudentApplicationSubmitted;
use App\Models\Intake;
use App\Models\Program;
use App\Models\StudentAdmission;
use App\Models\StudentsApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Mail;
use Auth;
use PDF;
use Validator;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('auth');
    }

    public function request(Request $request, $action)
    {
        switch ($action) {
            default:

                return response()->json(['error' => 1, 'message' => 'Invalid Action']);
                break;

            case 'intakes':
                $intakes = Intake::where('status', 1)
                    ->where('start_date', '>=', date('Y-m-d'))
                    ->pluck('name', 'id');

                return response()->json(['error' => 0, 'intakes' => $intakes]);
                break;

            case 'programs':
                $programs = Program::where('status', 1)
                    ->pluck('name', 'id');

                return response()->json(['error' => 0, 'programs' => $programs]);
                break;
        }
    }

    public function saveApplication(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'first_name'             => 'required|max:100',
            'last_name'              => 'required|max:100',
            'email'                  => 'required|email|unique:users',
            'country_of_citizenship' => 'required',
            'passport_number'        => 'required',
            'gender'                 => 'required',
            'dob'                    => 'required',

            'home_address'  => 'required',
            'home_postcode' => 'required',
            'home_country'  => 'required',
            'home_phone'    => 'required',

            'academic_qualification_name' => 'required',
            'academic_qualification_year' => 'required',
            //'programs'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()
                ->json([
                    'error'   => 1,
                    'message' => $validator->errors()->first()
                ]);
        }

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

        if (count($programs) == 0) {
            return response()->json(['error' => 1, 'message' => 'Select at least one Post Secondary Program']);
        } elseif (count($intakes) == 0) {
            return response()->json(['error' => 1, 'message' => 'Select at least one Intake you are interested in']);
        }

        $students_application_data = [
            'last_name'                   => $last_name,
            'first_name'                  => $first_name,
            'middle_name'                 => $middle_name,
            'email'                       => $email,
            'country_of_citizenship'      => $country_of_citizenship,
            'passport_number'             => $passport_number,
            'gender'                      => $gender,
            'dob'                         => !is_null($dob) ? Carbon::parse($dob) : null,
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
            'english_test_date'           => !is_null($english_test_date) ? Carbon::parse($english_test_date) : null,
            'programs_ids'                => implode(',', $programs),
            'intake_ids'                  => implode(',', $intakes),
            'admission_status'            => Constant::ADMISSION_STATUS_PENDING
        ];

        $students_application = StudentsApplication::create($students_application_data);

        $students_application->application_no = 100000 + (int)$students_application->id;
        $students_application->save();

        if ($students_application) {
            $programs_ids = explode(',', $students_application->programs_ids);
            $intake_ids = explode(',', $students_application->intake_ids);

            $programs = Program::where('status', 1)
                ->whereIn('id', $programs_ids)
                ->pluck('name');

            $intakes = Intake::where('status', 1)
                ->whereIn('id', $intake_ids)
                ->pluck('name', 'id');

            $pdf = PDF::loadView('applications.students_application_pdf', compact('students_application', 'programs', 'intakes'));

            if ($email != '') {
                Mail::to($email)->send(new StudentApplicationSubmitted($students_application, $pdf));
            }
        }

        return response()->json(['error' => 0, 'message' => 'Your Application No. is ' . $students_application->application_no . '. other information sent to your given email.', 'id' => $students_application->application_no]);
    }

    // Testing only for PDF attached in email
    public function students_application_pdf(Request $request, $id)
    {
        $auth_user = Auth::user();

        $students_application = StudentsApplication::where('id', $id)->first();
        if ($students_application) {

            $programs_ids = explode(',', $students_application->programs_ids);
            $intake_ids = explode(',', $students_application->intake_ids);

            $programs = Program::where('status', 1)
                ->whereIn('id', $programs_ids)
                ->pluck('name');

            $intakes = Intake::where('status', 1)
                ->whereIn('id', $intake_ids)
                ->pluck('name', 'id');

            $download = $request->input('download', 0);
            $email = $students_application->email;
            if ($download) {
                $pdf = PDF::loadView('applications.students_application_pdf', compact('students_application', 'programs', 'intakes'));

                //$filename = 'Students Application #' . $students_application->application_no . '.pdf';

                //return $pdf->download($filename);

                Mail::to($email)->send(new StudentApplicationSubmitted($students_application, $pdf));
            } else {
                return view('applications.students_application_pdf', compact('students_application', 'programs', 'intakes'));
            }

        }
        return redirect(route('applications'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
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


    public function index()
    {
        //$programs = Program::where('status', 1)->get();
        $programs = Program::all();

        $level_of_study = config('app.level_of_study');
        $type_of_program = config('app.type_of_program');
        $academic_status = config('app.academic_status');

        return view('programs.index', compact('programs', 'level_of_study', 'type_of_program', 'academic_status'));
    }

    public function create()
    {
        $intakes = Intake::where('status', 1)->get();
        return view('programs.create', compact('intakes'));
    }

    public function save(Request $request)
    {

        $validation_rules = [
            'name'                   => 'required|max:255',
            'academic_status'        => 'required',
            'hours_per_week'         => 'required',
            'level_of_study'         => 'required',
            'type_of_program'        => 'required',
            'total_fees'             => 'required',
            //'program_duration_weeks' => 'required',
            //'program_intakes'        => 'required',
        ];

        $this->validate($request, $validation_rules); //, $messages

        $type_of_program = $request->input('type_of_program');
        $type_of_program_other = '';
        if ($type_of_program == 'other') {
            $type_of_program_other = $request->input('type_of_program_other');
        }

        $program_intakes = $request->input('program_intakes', []); // intake_ids


        $program = Program::create([
            'name'                   => $request->input('name'),
            'academic_status'        => $request->input('academic_status'),
            'hours_per_week'         => $request->input('hours_per_week'),
            'level_of_study'         => $request->input('level_of_study'),
            'type_of_program'        => $type_of_program,
            'type_of_program_other'  => $type_of_program_other,
            'total_fees'             => $request->input('total_fees'),
            'program_duration_weeks' => $request->input('program_duration_weeks'),
            'program_duration_years' => $request->input('program_duration_years'),
            'intake_ids'             => implode(',', $program_intakes),
            'status'                 => ($request->has('status') ? 1 : 0),
        ]);

        session()->flash('success', 'Program created successfully.');

        return redirect(route('programs'));
    }

    public function edit($id)
    {
        $program = Program::where('id', $id)->first();
        if ($program) {
            $intakes = Intake::where('status', 1)->get();
            $intake_ids = $program->intake_ids;
            $intake_ids = explode(',', $intake_ids);
            if (!is_array($intake_ids)) {
                $intake_ids = [];
            }
            return view('programs.edit', compact('program', 'intakes', 'intake_ids'));
        }
        return redirect()->route('programs');

    }

    public function update(Request $request, $id)
    {
        $program = Program::where('id', $id)->first();
        if ($program) {

            $validation_rules = [
                'name'                   => 'required|max:255',
                'academic_status'        => 'required',
                'hours_per_week'         => 'required',
                'level_of_study'         => 'required',
                'type_of_program'        => 'required',
                'total_fees'             => 'required',
                //'program_duration_weeks' => 'required',
                //'program_intakes'        => 'required',
            ];

            $this->validate($request, $validation_rules); //, $messages

            $type_of_program = $request->input('type_of_program');
            $type_of_program_other = '';
            if ($type_of_program == 'other') {
                $type_of_program_other = $request->input('type_of_program_other');
            }

            $program_intakes = $request->input('program_intakes', []); // intake_ids

            $program_date = [
                'name'                   => $request->input('name'),
                'academic_status'        => $request->input('academic_status'),
                'hours_per_week'         => $request->input('hours_per_week'),
                'level_of_study'         => $request->input('level_of_study'),
                'type_of_program'        => $type_of_program,
                'type_of_program_other'  => $type_of_program_other,
                'total_fees'             => $request->input('total_fees'),
                'program_duration_weeks' => $request->input('program_duration_weeks'),
                'program_duration_years' => $request->input('program_duration_years'),
                'intake_ids'             => implode(',', $program_intakes),
                'status'                 => ($request->has('status') ? 1 : 0),
            ];

            $program->update($program_date);

            session()->flash('success', 'Program updated successfully.');

            return redirect(route('programs'));
        }
        return redirect('/');

    }

    public function delete(Request $request, $id)
    {
        $program = Program::where('id', $id)->first();
        if ($program) {
            $program->delete();
            return response()->json(['error' => 0, 'message' => 'Success']);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Action']);
    }

    public function intakes()
    {
        //$intakes = Intake::where('status', 1)->get();
        $intakes = Intake::all();

        return view('programs.intakes', compact('intakes'));
    }

}
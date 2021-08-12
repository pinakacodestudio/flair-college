<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\College;
use App\Models\CollegeCampus;
use App\Models\CollegeStaff;
use Illuminate\Http\Request;

use Auth;
use DB;

class CollageController extends Controller
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

    public function settings()
    {
        $user = $this->authUser;

        $college_id = config('app.college_id');

        $college = College::where('id', $college_id)->first();
        $college_staffs = CollegeStaff::where('college_id', $college_id)->get();

        if ($college) {

            return view('settings', compact('user', 'college', 'college_staffs'));
        }
        session()->flash('error', 'College detail not found.');
        return redirect('/');
    }

    public function settings_update(Request $request)
    {
        $auth_user = $this->authUser;

        $college_id = config('app.college_id');

        $college = College::where('id', $college_id)->first();

        if ($college) {
            $validation_rules = [
                'name'       => 'required|max:255',
                'dli_number' => 'required|max:255',
                'email'      => 'required|email|max:255',
            ];

            $this->validate($request, $validation_rules); //, $messages

            $college_date = [
                'name'             => $request->input('name'),
                'dli_number'       => $request->input('dli_number'),
                'email'            => $request->input('email'),
                'po_box'           => $request->input('po_box'),
                'street_no'        => $request->input('street_no'),
                'street_name'      => $request->input('street_name'),
                'city'             => $request->input('city'),
                'province'         => $request->input('province'),
                'postcode'         => $request->input('postcode'),
                'phone'            => $request->input('phone'),
                'extension'        => $request->input('extension'),
                'fax'              => $request->input('fax'),
                'institution_type' => $request->input('institution_type'),
            ];

            $college->update($college_date);

            session()->flash('success', 'Collage information updated successfully.');

            return redirect(route('settings'));
        }
        return redirect('/');
    }


    public function staffs()
    {
        $user = $this->authUser;

        $college_id = config('app.college_id');
        $staff_position = config('app.staff_position');

        $college_staffs = CollegeStaff::where('college_id', $college_id)->get();

        return view('staffs.index', compact('college_staffs', 'staff_position'));
    }

    public function staff_create()
    {
        $auth_user = $this->authUser;

        $staff_position = config('app.staff_position');

        return view('staffs.create', compact('staff_position'));
    }

    public function staff_save(Request $request)
    {
        $auth_user = $this->authUser;

        $validation_rules = [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'mobile'     => 'required|max:20',
            'position'   => 'required',
            //'extension'  => 'required|max:50',
        ];

        $this->validate($request, $validation_rules); //, $messages

        $college_id = config('app.college_id');

        $college_staff_date = [
            'college_id' => $college_id,
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'mobile'     => $request->input('mobile'),
            'position'   => $request->input('position'),
            'extension'  => $request->input('extension'),

            'status' => ($request->has('status') ? 1 : 0),
        ];

        $college_staff = CollegeStaff::create($college_staff_date);

        if ($college_staff && $request->hasFile('signature_image')) {
            $signature_image = $request->file('signature_image');

            $filename = $college_staff->id . "_signature." . $signature_image->getClientOriginalExtension();

            $signature_image->storeAs(Constant::SIGNATURE_FOLDER, $filename);

            $college_staff->signature_filename = $filename;
            $college_staff->save();
        }

        session()->flash('success', 'College staff created successfully.');

        return redirect(route('staffs'));
    }

    public function staff_edit($id)
    {
        $auth_user = $this->authUser;

        $college_staff = CollegeStaff::find($id);
        if ($college_staff) {

            $staff_position = config('app.staff_position');
            return view('staffs.edit', compact('college_staff', 'staff_position'));
        }
        return redirect()->route('staffs');

    }

    public function staff_update(Request $request, $id)
    {
        $auth_user = $this->authUser;

        $college_staff = CollegeStaff::find($id);
        if ($college_staff) {

            $validation_rules = [
                'first_name' => 'required|max:255',
                'last_name'  => 'required|max:255',
                'mobile'     => 'required|max:20',
                'position'   => 'required',
                //'extension'  => 'required|max:50',
            ];

            $this->validate($request, $validation_rules); //, $messages

            $remove_signature_image = $request->input('remove_signature_image');

            $college_staff_date = [
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'mobile'     => $request->input('mobile'),
                'position'   => $request->input('position'),
                'extension'  => $request->input('extension'),

                'status' => ($request->has('status') ? 1 : 0),
            ];

            if ($remove_signature_image == 1) {
                $college_staff_date['signature_filename'] = '';
            }

            if ($request->hasFile('signature_image')) {
                $signature_image = $request->file('signature_image');

                $filename = $college_staff->id . "_signature." . $signature_image->getClientOriginalExtension();

                $signature_image->storeAs(Constant::SIGNATURE_FOLDER, $filename);

                $college_staff_date['signature_filename'] = $filename;
            }

            $college_staff->update($college_staff_date);

            session()->flash('success', 'College staff updated successfully.');

            return redirect(route('staffs'));
        }
        return redirect('/');

    }

    public function staff_delete(Request $request, $id)
    {
        $auth_user = $this->authUser;

        $college_staff = CollegeStaff::find($id);
        if ($college_staff) {
            $college_staff->delete();
            return response()->json(['error' => 0, 'message' => 'Success']);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Action']);
    }

    // College Campus

    public function campus()
    {
        $user = $this->authUser;

        $college_id = config('app.college_id');

        $college_campus = CollegeCampus::where('college_id', $college_id)->get();


        return view('college_campus.index', compact('college_campus'));
    }

    public function campus_create()
    {
        $auth_user = $this->authUser;

        $college_id = config('app.college_id');
        $college_staffs = CollegeStaff::where('college_id', $college_id)
            ->where('status', 1)
            ->get();

        return view('college_campus.create', compact('college_staffs'));
    }

    public function campus_save(Request $request)
    {
        $auth_user = $this->authUser;

        $validation_rules = [
            'name'     => 'required|max:255',
            'staff_id' => 'required'
        ];

        $this->validate($request, $validation_rules); //, $messages

        $college_id = config('app.college_id');

        $college_campus_date = [
            'college_id' => $college_id,
            'staff_id'   => $request->input('staff_id'),
            'altstaff_id'=>$request->input('altstaff_id'),
            'name'       => $request->input('name'),
            'address'    => $request->input('address'),
            'city'       => $request->input('city'),
            'postcode'   => $request->input('postcode'),
            'phone'      => $request->input('phone'),

            'status' => ($request->has('status') ? 1 : 0),
        ];

        $college_campus = CollegeCampus::create($college_campus_date);

        session()->flash('success', 'College campus created successfully.');

        return redirect(route('campus'));
    }

    public function campus_edit($id)
    {
        $auth_user = $this->authUser;

        $college_campus = CollegeCampus::find($id);
        if ($college_campus) {

            $college_id = config('app.college_id');
            $college_staffs = CollegeStaff::where('college_id', $college_id)
                ->where('status', 1)
                ->get();

            return view('college_campus.edit', compact('college_campus', 'college_staffs'));
        }
        return redirect()->route('campus');

    }

    public function campus_update(Request $request, $id)
    {
        $auth_user = $this->authUser;

        $college_campus = CollegeCampus::find($id);
        if ($college_campus) {

            $validation_rules = [
                'name'     => 'required|max:255',
                'staff_id' => 'required'
            ];

            $this->validate($request, $validation_rules); //, $messages

            $college_campus_date = [
                'staff_id' => $request->input('staff_id'),
                'altstaff_id'=>$request->input('altstaff_id'),
                'name'     => $request->input('name'),
                'address'  => $request->input('address'),
                'city'     => $request->input('city'),
                'postcode' => $request->input('postcode'),
                'phone'    => $request->input('phone'),
                'status' => ($request->has('status') ? 1 : 0),
            ];

            $college_campus->update($college_campus_date);

            session()->flash('success', 'College campus updated successfully.');

            return redirect(route('campus'));
        }
        return redirect('/');

    }

    public function campus_delete(Request $request, $id)
    {
        $auth_user = $this->authUser;

        $college_campus = CollegeCampus::find($id);
        if ($college_campus) {
            $college_campus->delete();
            return response()->json(['error' => 0, 'message' => 'Success']);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Action']);
    }

}

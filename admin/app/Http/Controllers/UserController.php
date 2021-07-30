<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Mail\UserWelcome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Mail;
use Validator;
use Auth;
use Hash;

class UserController extends Controller
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
        $auth_user = $this->authUser;

        $users = User::userOnly();

        if ($auth_user->user_type == 'super_admin') {
            //$users = $users->where();
        } else {
            $users = $users->where('parent_id', $auth_user->id);
        }
        $users = $users->get();
        //$users = User::all();

        $user_types = config('app.user_types');

        return view('users.index', compact('users', 'user_types'));
    }


    public function create()
    {
        $auth_user = $this->authUser;

        $user_types = config('app.user_types');
        $index = array_search($auth_user->user_type, array_keys($user_types));
        if ($index !== false) {
            $user_types = array_slice($user_types, $index + 1);
        }

        return view('users.create', compact('user_types'));
    }

    public function save(Request $request)
    {
        $auth_user = $this->authUser;

        $validation_rules = [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'mobile'     => 'required',
            'email'      => 'required|email|unique:users',
            'user_type'  => 'required',
            'address'    => 'required',
            'city'       => 'required',
            'country'    => 'required',
            //'password'   => 'required|confirmed|min:6',
        ];

        $this->validate($request, $validation_rules); //, $messages

        $email = $request->input('email');
        $user_type = $request->input('user_type');

        $invitation_token = hash_hmac('sha256', str_random(40), config('app.key'));

        $user_date = [
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'mobile'     => $request->input('mobile'),
            'email'      => $email,
            'user_type'  => $user_type,
            'gender'     => $request->input('gender'),
            'address'    => $request->input('address'),
            'city'       => $request->input('city'),
            'country'    => $request->input('country'),
            //'password'   => bcrypt($request->input('password')),

            //'invitation_token' => $invitation_token,

            'status' => 0,
        ];

        if ($user_type == 'sub_agent') {
            $user_date['status'] = 1;
            $user_date['email_verified'] = 1;
            $user_date['parent_id'] = $auth_user->id;
        } else {
            $user_date['invitation_token'] = $invitation_token;
            $user_date['email_verified'] = 0;
        }

        $user = User::create($user_date);

        if ($user) {
            if ($user->user_type == 'sub_agent') {
                Mail::to($email)->send(new UserWelcome($user));
            } else {
                Mail::to($email)->send(new UserCreated($user));
            }
        }

        session()->flash('success', 'User created successfully.');

        return redirect(route('users'));
    }

    public function edit($id)
    {
        $auth_user = $this->authUser;

        $user = User::userOnly()->where('id', $id);
        if ($auth_user->user_type == 'super_admin') {

        } else {
            $user = $user->where('parent_id', $auth_user->id);
        }
        $user = $user->first();
        if ($user) {

            $user_types = config('app.user_types');
            return view('users.edit', compact('user', 'user_types'));
        }
        return redirect()->route('users');

    }

    public function update(Request $request, $id)
    {
        $auth_user = $this->authUser;

        $user = User::userOnly()->where('id', $id)->first();
        if ($user) {
            $user_type = $request->input('user_type');
            $reset_password = $request->input('reset_password', false);
            $password = $request->input('password');

            $validation_rules = [
                'first_name' => 'required|max:255',
                'last_name'  => 'required|max:255',
                'email'      => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
                'mobile'     => 'required',
                'address'    => 'required',
                'city'       => 'required',
                'country'    => 'required',
                'user_type'  => 'required',
            ];

            // disable reset password checkbox if checked
            if ($user_type == 'sub_agent') {
                $reset_password = false;
            }

            if ($reset_password) {
                $validation_rules['password'] = 'required|confirmed|min:6';
            }

            $this->validate($request, $validation_rules); //, $messages


            $user_date = [
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'mobile'     => $request->input('mobile'),
                'email'      => $request->input('email'),
                'user_type'  => $user_type,
                'gender'     => $request->input('gender'),
                'address'    => $request->input('address'),
                'city'       => $request->input('city'),
                'country'    => $request->input('country'),
                'status'     => ($request->has('status') ? 1 : 0),
            ];

            if ($reset_password) {
                $user_date['password'] = bcrypt($password);
            }

            $user->update($user_date);

            session()->flash('success', 'User updated successfully.');

            return redirect(route('users'));
        }
        return redirect('/');

    }

    public function delete(Request $request, $id)
    {
        $auth_user = $this->authUser;

        $user = User::userOnly()->where('id', $id);
        if ($auth_user->user_type == 'super_admin') {

        } else {
            $user = $user->where('parent_id', $auth_user->id);
        }
        $user = $user->first();
        if ($user) {
            $user->delete();
            return response()->json(['error' => 0, 'message' => 'Success']);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Action']);
    }

    public function setInvitationPassword(Request $request, $token)
    {
        $email = $request->input('email');
        return view('users.set_invitation_password', compact('email', 'token'));
    }

    public function saveInvitationPassword(Request $request)
    {
        $this->validate($request, [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        $token = $request->input('token');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('invitation_token', $token)->where('email', $email)->first();

        if ($user) {
            $user->update([
                'password'         => bcrypt($password),
                'remember_token'   => str_random(60),
                'invitation_token' => NULL,
                'email_verified'   => 1,
            ]);

            Auth::login($user);

            // send the email
            Mail::to($email)->send(new UserWelcome($user));

            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid invitation link.']);
        }
    }


    /*public function sub_agents_index()
    {
        $auth_user = $this->authUser;

        $sub_agents = User::mySubAgentOnly($auth_user->id)->get();
        //$users = User::all();
        return view('sub_agents.index', compact('sub_agents'));
    }


    public function sub_agents_create()
    {
        return view('sub_agents.create');
    }

    public function sub_agents_save(Request $request)
    {
        $auth_user = $this->authUser;

        $validation_rules = [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'mobile'     => 'required',
            'email'      => 'required|email|unique:users',
            'address'    => 'required',
            'city'       => 'required',
            'country'    => 'required',
        ];

        $this->validate($request, $validation_rules); //, $messages

        $sub_agent = User::create([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'mobile'     => $request->input('mobile'),
            'email'      => $request->input('email'),
            'gender'     => $request->input('gender'),
            'address'    => $request->input('address'),
            'city'       => $request->input('city'),
            'country'    => $request->input('country'),
            'status'     => ($request->has('status') ? 1 : 0),

            'user_type' => 'sub_agent',
            'parent_id' => $auth_user->id
        ]);

        return redirect(route('users'));
    }

    public function sub_agents_edit($id)
    {
        $sub_agent = User::subAgentOnly()->where('id', $id)->first();
        if ($sub_agent) {

            return view('sub_agents.edit', compact('sub_agent'));
        }
        return redirect()->route('users');

    }

    public function sub_agents_update(Request $request, $id)
    {

        $sub_agent = User::subAgentOnly()->where('id', $id)->first();
        if ($sub_agent) {

            $validation_rules = [
                'first_name' => 'required|max:255',
                'last_name'  => 'required|max:255',
                'email'      => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($sub_agent->id),
                ],
                'mobile'     => 'required',
                'address'    => 'required',
                'city'       => 'required',
                'country'    => 'required',
            ];


            $this->validate($request, $validation_rules); //, $messages

            $user_date = [
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'mobile'     => $request->input('mobile'),
                'email'      => $request->input('email'),
                'gender'     => $request->input('gender'),
                'address'    => $request->input('address'),
                'city'       => $request->input('city'),
                'country'    => $request->input('country'),
                'status'     => ($request->has('status') ? 1 : 0),
            ];

            $sub_agent->update($user_date);

            return redirect(route('users'));
        }
        return redirect('/');

    }

    public function sub_agents_delete(Request $request, $id)
    {
        $sub_agent = User::subAgentOnly()->where('id', $id)->first();
        if ($sub_agent) {
            $sub_agent->delete();
            return response()->json(['error' => 0, 'message' => 'Success']);
        }
        return response()->json(['error' => 1, 'message' => 'Invalid Action']);
    }*/

}
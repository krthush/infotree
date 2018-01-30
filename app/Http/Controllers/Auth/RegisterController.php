<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Tree;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        // Closed Alpha
        // $customMessages = [
        //     'exists' => 'Email provided is not registered for alpha testing. Currently infotree is in closed alpha and only registered emails are allowed. Please contact Thush and ask to be added to the mailing list.'
        // ];

        // return Validator::make($data, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users|exists:emails,email',
        //     'password' => 'required|string|min:6|confirmed',
        // ], $customMessages);

        // Open Alpha
        $customMessages = [];

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], $customMessages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /* Check if initial records exsist on creation of first user */
        $admin = Role::where('name', '=', 'admin')->first();
        $student = Role::where('name', '=', 'student')->first();
        $user = User::where('id', '=', 1)->first();
        $tree = Tree::where('id', '=', 1)->first();



        /* Create initial records exsist if they don't exsist */       
        if ($student === null) {
            Role::create(['name' => 'student']);
        }

        /* First admin is created with a university tree */
        if ($admin === null) {
            Role::create(['name' => 'admin']);
        }
        if ($tree === null) {
            Tree::create([
                'title' => 'University',
                'user_id' => 1,
                'university' => true,
                'shared' => true,
                'favourite'=> true
            ]);
        }



        /* User creation */
        if ($user === null) {
            /* First user created is admin, who creates university records */
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ])->assignRole('admin');
        } else {
            /* Other users created */
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ])->assignRole('student');
        }
    }
}

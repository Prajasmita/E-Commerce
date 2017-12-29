<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Custom;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
//use DB;
//
//use Illuminate\Validation\ValidationException;
//use Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request){


        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if($request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ])){
            $email=$request->input('email');
            $password=$request->input('password');

            if (Auth::attempt([
                    'email' => $email,
                    'password' => $password]
            )) {

                $user = Auth::user();

                if($user->role_id == '5'){

                    Auth::logout();
                    return redirect()->route('login')->with('message', 'Failed : You Are Unautherized User.');
                }
            }
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            return $this->sendLoginResponse($request);

        }


        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);

    }



}

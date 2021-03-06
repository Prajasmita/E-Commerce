<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Custom;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
Use App\User;
use DB;
use Illuminate\Support\Facades\Log;
//
//use Illuminate\Validation\ValidationException;
//use Validator;

Use Hash;
class UserLoginController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('guest')->except('logout');
    }
    /*
    * Function for admin login form
    *
    * @return \Illuminate\View\View
    */
    public function showLoginForm()
    {
        return view('user_login',array('conf'=> $this->conf));
    }
    /*
     * Function for login opration
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {
       /* Log::useDailyFiles(storage_path().'/logs/rashmi.log');*/
        $user = User::where('email',$request->email)->first();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


            if ($user) {

                if($user->status){
                    if ($this->attemptLogin($request)) {
                        return $this->sendLoginResponse($request);
                    }
                }
                else
                {
                    return redirect('/register')->with('login_errors', 'Sorry,You have not permission to login.');
                }

            }

        $this->incrementLoginAttempts($request);

        $this->sendFailedLoginResponse($request);

    }
    /*
     * Function for logout operation.
     *
     * @return \Illuminate\View\View
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }


}

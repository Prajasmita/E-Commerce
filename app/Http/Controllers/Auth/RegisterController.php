<?php

namespace App\Http\Controllers\Auth;

use App\Configuration;
use App\Email_template;
use App\Helper\Custom;
use App\User;
Use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/register';

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
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact_no' => 'required|regex:/(9)[0-9]{9}/'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'contact_no' => $data['contact_no'],
            'role_id' => 5
        ]);

        $template_content = Email_template::where('title','=','user_register')->select('content')->first();

        $email = $data['email'];
        $string = array();
        $string[0] = '{User name}';
        $string[1] = '{email}';
        $string[2] = '{password}';

        $replace=array();
        $replace[0] = $data['first_name'];
        $replace[1] = $data['email'];
        $replace[2] = $data['password'];

        $new_template_content = str_replace($string,$replace, $template_content->content);

        $admin_email = Configuration::where('conf_key','=','Admin_email')->select('conf_value')->first();

        $admin_mail = $admin_email->conf_value;

        $admin_template_content = Email_template::where('title','=','user_register for Admin')->select('content')->first();

        $admin_content = str_replace([$string[0],$string[1]],[$replace[0],$replace[1]], $admin_template_content->content);

        Mail::send([], [], function ($message) use ($new_template_content,$email)
         {
             $message->to($email)
                 ->subject('Successful Registration')
                 ->setBody(html_entity_decode(strip_tags($new_template_content)));

         });

        Mail::send([], [], function ($message) use ($admin_content,$admin_mail)
        {

            $message->to($admin_mail)
                ->subject('Successful Registration of customer')
                ->setBody(html_entity_decode(strip_tags($admin_content)));
        });
        return redirect('register')->with('flash_message', 'You are register successfully !!!');

    }

    public function showRegistrationForm()
    {
        return view('user_login');
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        return $this->create($request->all());

    }
}

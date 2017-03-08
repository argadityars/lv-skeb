<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationVerification;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

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
            'name' => 'required|alpha_spaces|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(32),
        ]);
    }

    /**
    *  Over-ridden the register method from the "RegistersUsers" trait
    *  Remember to take care while upgrading laravel
    */
    public function register(Request $request)
    {
        /**
         * Validate registration input values
         */
        $validator = $this->validator($request->all());
        if ($validator->fails()) 
        {
            $this->throwValidationException($request, $validator);
        }

        /**
         * If validation success, begin transaction
         */
        DB::beginTransaction();
        try
        {
            // Create new user
            $user = $this->create($request->all());
            
            // Send an email with the random token generated in the create method above
            $email = new RegistrationVerification(new User([
                'name' => $user->name, 
                'email_token' => $user->email_token
            ]));
            Mail::to($user->email)->send($email);

            //Commit transaction
            DB::commit();
            return view('auth.success');
        }
        catch(Exception $e)
        {
            DB::rollback(); 
            return back();
        }
    }

    /**
     * Verify user by email token
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    public function verify($token)
    {
        User::where('email_token', $token)->firstOrFail()->verified();
        return redirect('login')->with('message', 'Email confirmed! You can login now.');
    }
}

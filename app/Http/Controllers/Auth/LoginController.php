<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Grpc\CallCredentials;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        return view('front.auth.login');
    }
    protected function validateLogin(Request $request)
    {
        $messages = [
            'email.required' => 'نام کاربری خود را وارد نمایید',
            'password.required' => ' رمز عبور خود را وارد نمایید',
        ];
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
//            recaptchaFieldName() => recaptchaRuleName(),
            // new rules here
        ],$messages);

    }


    public function attemptLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember?true:false)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('home'));
        }
    }


}

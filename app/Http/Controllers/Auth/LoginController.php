<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated()
    {

        if(auth()->user()->roles()->count()<1 OR auth()->user()->hasRole('user'))
        {
            
            if(session()->has('redirect-url')){                
                $red_url=session()->get('redirect-url');
                session()->forget('redirect-url');
                return redirect($red_url);
            }

            return redirect(RouteServiceProvider::HOME);
        } 
        else{
            return redirect(RouteServiceProvider::ADMIN);
        }

    }

    public function userloginform()
    {
      return view('auth.user-login');
    }


}

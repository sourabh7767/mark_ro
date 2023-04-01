<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\User;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $rules = array(
            'email' => 'required|email:rfc,dns,filter',
            'password' => 'required',
            'role' => 'required|in:User,Admin'
        );
        $message = array('role' => '');
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $user = User::where("email", $request->email)->leftJoin('roles', 'users.role', 'roles.id')->first();
        // echo "<pre>"; print_r($user); die;

        if(!empty($user) && $user['title'] == $request->role){
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('user.home');
            }else{
                return $this->sendFailedLoginResponse($request);
            }
        }else{
            return $this->sendFailedLoginResponse($request);
        }

        return redirect()->route('user.home');

    }

    public function logout(Request $request){

        if(getRole() == 'Admin'){
            Auth::logout();
            return redirect('/admin/login');
        }else{
            Auth::logout();
            return redirect('/login');
        }
    }
}

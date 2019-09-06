<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use App\Student;
use Carbon\Carbon; // Thu vien xu ly thoi gian
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Function login for student
     *  Param: username and password
     *
     * @return str token
     */
    public function loginStudent(Request $request)
    {
        if (!$request->username && !$request->password) {
            return response()->json(["message"=>"Username or password not found"], 401);
        }

        $checkLogin = Student::where('username',$request->username)
            ->where('password',$request->password)->first();
        
        if (!$checkLogin) { 
            return response()->json(["message"=>"Login faild, please check again"], 403);
        }

        // Login success encode start time and id student
        $carbonNow = Carbon::now();
        $remember_token = md5($checkLogin->id."_".$carbonNow);

        if ($remember_token) {
            return response()->json(["message"=>$remember_token], 200);
        }
        return response()->json(["message"=>"System erros"], 500);
    }

    public function loginAdmin() 
    {

    }
}

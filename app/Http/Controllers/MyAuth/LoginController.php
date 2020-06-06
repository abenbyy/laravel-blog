<?php

namespace App\Http\Controllers\MyAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        //abort(403); //for error page testing
        return view('myauth.login');
    }

    public function login(Request $request)
    {
        if(Auth::attempt([
            'email' => $request->account, 
            'password' => $request->password,
        ]) || Auth::attempt([
            'nim' => $request->account, 
            'password' => $request->password,
        ])){
            //success
            return redirect('auth/profile');

        }

        //fail
        return back();
    }

    public function logout(){
        Auth::logout();
        Auth::check();
        return redirect('/auth/login');
    }
}

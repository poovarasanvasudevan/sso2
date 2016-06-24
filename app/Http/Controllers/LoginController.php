<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

class LoginController extends Controller
{
    //
    public function login()
    {
        $username = request()->input('username');
        $password = request()->input('password');
        $remember = request()->input('remember');

        $user = User::where('email', $username)->where('password', md5($password))->first();
        if ($user) {
            Auth::loginUsingId($user->id, $remember);
            return response()->json(array('result' => 'success'));

        } else {
            return response()->json(array('result' => 'failure'));

        }
    }

    public function dashboard()
    {
        if (!Auth::user()) {
            Session::flash('message', 'You Login First');
            return response()->redirectTo('/');
        } else {
            return response()->view('dashboard.dashboard');
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->redirectTo('/');
    }
}

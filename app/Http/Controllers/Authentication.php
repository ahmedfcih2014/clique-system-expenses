<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    function login_get() {
        return view('login');
    }

    function login_post() {
        // here we most use FormRequest as a arg in function ,but validation is too simple
        $this->validate(request() ,[
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        $user_logged_in = Auth::attempt(['username' => request('username'), 'password' => request('password')]);
        
        return
            $user_logged_in ?
                redirect(route('expenses.index'))
                :
                redirect()->back()->withInput()->with('error' ,'Invalid credentials');
    }

    function logout() {
        Auth::logout();
        return redirect(route('login'));
    }
}

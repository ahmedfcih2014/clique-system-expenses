<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    function api_login() {
        if (!request()->has('username') || !request()->has('password'))
            return $this->api_login_error();
        
        $username = request('username');
        $password = request('password');

        $user = User::where('username' ,$username)->first();
        if ($user && Hash::check($password ,$user->password)) {
            return response([
                'message' => 'Welcome to API ,please use user_id to your all requests',
                'user_id' => $user->id
            ]);
        }
        return $this->api_login_error();
    }

    private function api_login_error() {
        return response(['message' => 'Enter valid credentials'] ,Response::HTTP_BAD_REQUEST);
    }
}

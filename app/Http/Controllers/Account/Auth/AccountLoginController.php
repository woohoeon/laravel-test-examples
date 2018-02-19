<?php

namespace App\Http\Controllers\Account\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('account.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login_id' => 'required|string',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt(['login_id' => $request->login_id, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('admin.top'));
        }

        return redirect()->back()->withInput($request->only('login_id', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}

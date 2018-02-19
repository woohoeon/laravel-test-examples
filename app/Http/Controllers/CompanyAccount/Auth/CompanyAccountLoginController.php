<?php

namespace App\Http\Controllers\CompanyAccount\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAccountLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:company')->except('logout');
    }

    public function showLoginForm()
    {
        return view('company-account.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login_id' => 'required|string',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('company')->attempt(['login_id' => $request->login_id, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('company.top'));
        }

        return redirect()->back()->withInput($request->only('login_id', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('company')->logout();

        return redirect('/');
    }
}

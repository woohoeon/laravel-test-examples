<?php

namespace App\Http\Controllers\AgentAccount\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentAccountLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:agent')->except('logout');
    }

    public function showLoginForm()
    {
        return view('agent-account.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login_id' => 'required|string',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('agent')->attempt(['login_id' => $request->login_id, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('agent.top'));
        }

        return redirect()->back()->withInput($request->only('login_id', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('agent')->logout();

        return redirect('/');
    }
}

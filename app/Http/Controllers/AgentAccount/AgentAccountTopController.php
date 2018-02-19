<?php

namespace App\Http\Controllers\AgentAccount;

use App\Http\Controllers\Controller;

class AgentAccountTopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:agent');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agent-account.top');
    }
}

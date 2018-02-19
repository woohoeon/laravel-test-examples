<?php

namespace App\Http\Controllers\CompanyAccount;

use App\Http\Controllers\Controller;

class CompanyAccountTopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company-account.top');
    }
}

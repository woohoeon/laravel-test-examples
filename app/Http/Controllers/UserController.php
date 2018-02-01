<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // showのみ
        // $this->middleware('can')->only('show');

        // show以外
        // $this->middleware('can')->except('show');
    }

    public function show($id)
    {
        return $id;
    }

    public function edit($id)
    {
        return 'Edit';
    }
}

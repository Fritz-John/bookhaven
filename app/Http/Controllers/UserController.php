<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


}

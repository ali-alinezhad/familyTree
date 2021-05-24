<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreeController extends Controller
{
    /**
     * TreeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('localization');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($locale)
    {
        return view('tree.home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * NewsController constructor.
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
        return view('news.home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * GalleryController constructor.
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
        return view('gallery.home');
    }
}

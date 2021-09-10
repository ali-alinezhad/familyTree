<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;

class IndexController extends Controller
{

    /**
     * @param string $locale
     *
     * @return Renderable
     */
    public function index(string $locale = 'fas'): Renderable
    {
        return view('welcome', [
            'locale'   => $locale,
            'homepage' => \App\Model\Homepage::first(),
            'news'     => '',
            'pictures' => '',
        ]);
    }
}

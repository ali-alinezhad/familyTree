<?php

namespace App\Http\Controllers;


use App\Model\Gallery;
use App\Model\News;
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
        $pictures = Gallery::orderBy('created_at', 'desc')->where('status', 1)->take(3)->get();
        $newses   = News::orderBy('created_at', 'desc')->where('status', 1)->take(4)->get();

        return view('welcome', [
            'locale'   => $locale,
            'homepage' => \App\Model\Homepage::first(),
            'newses'   => $newses,
            'pictures' => $pictures,
        ]);
    }
}

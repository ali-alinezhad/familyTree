<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    /**
     * @param string  $locale
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function index(string $locale,Request $request): RedirectResponse
    {
        if(!$request->user()) {
            return redirect()->intended(route('index.page'));
        }
        session()->put('user', $request->user()->username);
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
   }
}

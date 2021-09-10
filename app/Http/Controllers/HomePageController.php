<?php

namespace App\Http\Controllers;

use App\Model\Homepage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller
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
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $locale)
    {
        return view('homepage.home', [
            'locale'   => $locale,
            'homepage' => Homepage::first()
        ]);

    }


    /**
     * @param Request $request
     * @param string  $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $locale)
    {
        $validator = Validator::make($request->all(), [
            'header_title'   => 'nullable|string',
            'header_des'     => 'nullable|string',
            'about_us_title' => 'nullable|string',
            'about_us_des'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $homepage = Homepage::first();

        $homepage->header_title   = $request->get('header_title') ?? $homepage->header_title;
        $homepage->header_des     = $request->get('header_des') ?? $homepage->header_des;
        $homepage->about_us_title = $request->get('about_us_title') ?? $homepage->about_us_title;
        $homepage->about_us_des   = $request->get('about_us_des') ?? $homepage->about_us_des;
        $homepage->save();

        return redirect()->intended(route('homepage.edit', [$locale, $homepage]));

    }
}

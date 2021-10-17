<?php

namespace App\Http\Controllers;

use App\Model\Homepage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller
{
    protected const LOGO_PATH    = 'images/logo/';
    public const LOGO_DEFAULT    = self::LOGO_PATH . 'logo.jpg';
    protected const MUSIC_PATH   = 'music/';


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
    public function update(Request $request, string $locale): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'header_title'   => 'nullable|string',
            'header_des'     => 'nullable|string',
            'about_us_title' => 'nullable|string',
            'about_us_des'   => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'music'          => 'nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:8192',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $homepage = Homepage::first();

        $homepage->header_title   = $request->get('header_title') ?? $homepage->header_title;
        $homepage->header_des     = $request->get('header_des') ?? $homepage->header_des;
        $homepage->about_us_title = $request->get('about_us_title') ?? $homepage->about_us_title;
        $homepage->about_us_des   = $request->get('about_us_des') ?? $homepage->about_us_des;

        $logo  = $request->logo;
        $music = $request->music;

        if ($logo) {
            $logoImageName = 'logo2.' . $logo->extension();
            $logoImage     = self::LOGO_PATH . $logoImageName;
            $logo->move(self::LOGO_PATH, $logoImageName);
            $homepage->logo  = $logoImage;
        }

        if ($music) {
            $musicName = 'music.' . $music->getClientOriginalExtension();
            $MusicFile = self::MUSIC_PATH . $musicName;
            $music->move(self::MUSIC_PATH, $musicName);
            $homepage->music = $MusicFile;
        }
        $homepage->save();

        return redirect()->intended(route('homepage.edit', [$locale, $homepage]));
    }


    /**
     * @param string $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLogo(string $locale): \Illuminate\Http\RedirectResponse
    {
        $homepage = Homepage::first();

        if ($homepage->logo !== self::LOGO_DEFAULT && file_exists($homepage->logo)) {
            unlink($homepage->logo);
        }

        $homepage->logo = self::LOGO_DEFAULT;

        $homepage->save();

        return redirect()->intended(route('homepage.edit', [$locale, $homepage]));
    }


    /**
     * @param string $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMusic(string $locale): \Illuminate\Http\RedirectResponse
    {
        $homepage = Homepage::first();

        if ($homepage->music) {
            unlink($homepage->music);
        }

        $homepage->music = '';
        $homepage->save();

        return redirect()->intended(route('homepage.edit', [$locale, $homepage]));
    }
}

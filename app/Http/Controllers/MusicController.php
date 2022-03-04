<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Model\Music;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MusicController extends Controller
{

    protected const PATH = 'images/music/';

    /**
     * @var Helper
     */
    private $helper;


    /**
     * GalleryController constructor.
     */
    public function __construct(Helper $helper)
    {
        $this->middleware('auth');
        $this->middleware('localization');
        $this->helper = $helper;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(string $locale)
    {
        $musics = DB::table('music')->paginate(8);
        return view('music.home', [
            'locale' => $locale,
            'user'   => $this->helper->getCurrentUser(),
            'musics' => $musics
        ]);
    }


    /**
     * @param Request $request
     * @param string  $locale
     *
     * @return RedirectResponse
     */
    public function upload(Request $request, string $locale): RedirectResponse
    {
        $user      = $this->helper->getCurrentUser();
        $music     = new Music();
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $music->user_id     = $user->id;
        $music->title       = $request->get('title');
        $music->description = $request->get('description');
        $music->status      = (bool) $request->get('status');
        $music->save();

        $file = $request->file;
        if ($file) {
            $musicName = $music->id . '.' . $file->extension();
            $musicFile = self::PATH . $musicName;
            $file->move(self::PATH, $musicFile);
        }

        $music->file = $musicFile ?? '';
        $music->save();

        return redirect()->intended(route('music', [$locale, $user]));
    }


    /**
     * @param string $locale
     * @param Music  $music
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $locale, Music $music)
    {
        return view('music.edit', [
            'locale' => $locale,
            'user'   => User::where('username', $this->helper->getCurrentUser()),
            'music'  => $music
        ]);
    }


    /**
     * @param Request $request
     * @param string  $locale
     * @param Music   $music
     *
     * @return RedirectResponse
     */
    public function update(Request $request, string $locale, Music $music): RedirectResponse
    {
        $user      = $this->helper->getCurrentUser();
        $validator = $this->validator($request, 'nullable');

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $music->user_id     = $user->id;
        $music->title       = $request->get('title');
        $music->description = $request->get('description');
        $music->status      = (bool) $request->get('status');
        $music->save();

        $file = $request->file;
        if ($file) {
            $file->move(self::PATH, $music->file);
        }

        $music->save();

        return redirect()->intended(route('music', [$locale, $user]));
    }


    /**
     * @param string $locale
     * @param Music  $music
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete(string $locale, Music $music): RedirectResponse
    {
        if (file_exists($music->file)) {
            unlink($music->file);
        }

        $music->delete();

        return redirect()->intended(route('music', [$locale, $this->helper->getCurrentUser()]));
    }


    /**
     * @param string $locale
     * @param Music  $music
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details(string $locale, Music $music)
    {
        return view('music.details', [
            'locale' => $locale,
            'user'   => User::where('username', $this->helper->getCurrentUser()),
            'music'  => $music
        ]);
    }


    /**
     * @param Request $request
     * @param string  $fileValid
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator(Request $request, string $fileValid = 'required'): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), [
            'title'       => 'nullable|string',
            'description' => 'nullable|string',
            'status'      => 'nullable|string',
            'file'        => $fileValid . '|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav|max:6144',
        ]);
    }
}

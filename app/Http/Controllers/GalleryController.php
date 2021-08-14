<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Model\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{

    protected const PATH = 'images/gallery/';

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
        $images = DB::table('gallery')->paginate(8);
        return view('gallery.home', [
            'locale' => $locale,
            'user'   => $this->helper->getCurrentUser(),
            'images' => $images
        ]);
    }


    /**
     * @param Request $request
     * @param string  $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request, string $locale)
    {
        $user      = $this->helper->getCurrentUser();
        $gallery   = new Gallery();
        $validator = Validator::make($request->all(), [
            'title'       => 'nullable|string',
            'description' => 'nullable|string',
            'status'      => 'nullable|string',
            'picture'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $gallery->user_id     = $user->id;
        $gallery->title       = $request->get('title');
        $gallery->description = $request->get('description');
        $gallery->status      = (bool) $request->get('status');

        $gallery->save();

        $picture = $request->picture;

        if ($picture) {
            $imageName = $gallery->id . '.' . $picture->extension();
            $image     = self::PATH . $imageName;
            $picture->move(self::PATH, $imageName);
        }

        $gallery->pic = $image;

        $gallery->save();

        return redirect()->intended(route('gallery', [$locale, $user]));
    }


    /**
     * @param string  $locale
     * @param Gallery $gallery
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $locale,Gallery $gallery)
    {
        return view('gallery.edit', [
            'locale'  => $locale,
            'user'    => \App\User::where('username', $this->helper->getCurrentUser()),
            'image'   => $gallery
        ]);

    }


    /**
     * @param Request $request
     * @param string  $locale
     * @param Gallery $gallery
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,string $locale,Gallery $gallery)
    {
        $user      = $this->helper->getCurrentUser();
        $validator = Validator::make($request->all(), [
            'title'       => 'nullable|string',
            'description' => 'nullable|string',
            'status'      => 'nullable|string',
            'picture'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $gallery->user_id     = $user->id;
        $gallery->title       = $request->get('title');
        $gallery->description = $request->get('description');
        $gallery->status      = (bool) $request->get('status');

        $gallery->save();

        $picture = $request->picture;

        if ($picture) {
            $picture->move(self::PATH, $gallery->pic);
        }

        $gallery->save();

        return redirect()->intended(route('gallery', [$locale, $user]));
    }


    /**
     * @param string  $locale
     * @param Gallery $gallery
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(string $locale,Gallery $gallery)
    {
        if(file_exists($gallery->pic)){
            unlink($gallery->pic);
        }

        $gallery->delete();

        return redirect()->intended(route('gallery', [$locale, $this->helper->getCurrentUser()]));
    }


    /**
     * @param string  $locale
     * @param Gallery $gallery
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details(string $locale,Gallery $gallery)
    {
        return view('gallery.details', [
            'locale' => $locale,
            'user'   => \App\User::where('username', $this->helper->getCurrentUser()),
            'image' => $gallery
        ]);

    }
}

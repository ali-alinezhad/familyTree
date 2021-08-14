<?php

namespace App\Http\Controllers;


use App\Http\Helpers\Helper;
use App\Model\News;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{

    protected const PATH = 'images/news/';


    /**
     * @var Helper
     */
    private $helper;


    /**
     * NewsController constructor.
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
    public function index($locale)
    {
        $news = DB::table('news')->paginate(8);
        return view('news.home', [
            'locale' => $locale,
            'user'   => $this->helper->getCurrentUser(),
            'news'   => $news
        ]);
    }


    /**
     * @param Request $request
     * @param string  $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, string $locale)
    {
        $user      = $this->helper->getCurrentUser();
        $news      = new News();
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string',
            'description' => 'required|string',
            'status'      => 'nullable|string',
            'picture'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $news->user_id     = $user->id;
        $news->title       = $request->get('title');
        $news->description = $request->get('description');
        $news->status      = (bool) $request->get('status');

        $news->save();

        $picture = $request->picture;

        if ($picture) {
            $imageName = $news->id . '.' . $picture->extension();
            $image     = self::PATH . $imageName;
            $picture->move(self::PATH, $imageName);
            $news->pic = $image;
            $news->save();
        }

        return redirect()->intended(route('news', [$locale, $user]));
    }


    /**
     * @param string $locale
     * @param News   $news
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $locale, News $news)
    {
        return view('news.edit', [
            'locale' => $locale,
            'user'   => User::where('username', $this->helper->getCurrentUser()),
            'news'   => $news
        ]);

    }


    /**
     * @param Request $request
     * @param string  $locale
     * @param News    $news
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $locale, News $news)
    {
        $user      = $this->helper->getCurrentUser();
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string',
            'description' => 'required|string',
            'status'      => 'nullable|string',
            'picture'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $news->user_id     = $user->id;
        $news->title       = $request->get('title');
        $news->description = $request->get('description');
        $news->status      = (bool) $request->get('status');

        $news->save();

        $picture = $request->picture;

        if ($picture) {
            $imageName = $news->id . '.' . $picture->extension();
            $image     = self::PATH . $imageName;
            $picture->move(self::PATH, $imageName);
            $news->pic = $image;
            $news->save();
        }

        return redirect()->intended(route('news', [$locale, $user]));
    }


    /**
     * @param string $locale
     * @param News   $news
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(string $locale, News $news)
    {
        if (file_exists($news->pic)) {
            unlink($news->pic);
        }

        $news->delete();

        return redirect()->intended(route('news', [$locale, $this->helper->getCurrentUser()]));
    }


    /**
     * @param      $locale
     * @param News $news
     *
     * @return RedirectResponse
     */
    public function deleteImage($locale,News $news): RedirectResponse
    {
        if(file_exists($news->pic)){
            unlink($news->pic);
        }

        $news->pic = 'images/unknown.png';
        $news->save();

        return redirect()->intended(route('news.edit', [$locale,$news, $this->helper->getCurrentUser()]));
    }


    /**
     * @param string $locale
     * @param News   $news
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details(string $locale, News $news)
    {
        return view('news.details', [
            'locale' => $locale,
            'user'   => User::where('username', $this->helper->getCurrentUser()),
            'news'   => $news
        ]);
    }
}

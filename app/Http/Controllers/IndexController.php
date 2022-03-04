<?php

namespace App\Http\Controllers;


use App\Model\Document;
use App\Model\Gallery;
use App\Model\Homepage;
use App\Model\Music;
use App\Model\News;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

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

        return view('index.homepage', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'newses'   => $newses,
            'pictures' => $pictures,
        ]);
    }


    /**
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNews(string $locale = 'fas')
    {
        $news = DB::table('news')
            ->orderBy('created_at', 'desc')
            ->where('status', 1)
            ->paginate(8);

        return view('index.news.home', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'news'     => $news,
        ]);
    }


    /**
     * @param string $locale
     * @param News   $news
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNewsDetails(string $locale, News $news)
    {
        return view('index.news.details', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'news'     => $news,
        ]);
    }


    /**
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowGallery(string $locale = 'fas')
    {
        $pictures = DB::table('gallery')
            ->orderBy('created_at', 'desc')
            ->where('status', 1)
            ->paginate(8);

        return view('index.gallery.home', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'pictures' => $pictures,
        ]);
    }


    /**
     * @param string  $locale
     * @param Gallery $gallery
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowImageDetails(string $locale, Gallery $gallery)
    {
        return view('index.gallery.details', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'picture'  => $gallery,
        ]);
    }


    /**
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowDocuments(string $locale = 'fas')
    {
        $documents = DB::table('documents')
            ->orderBy('created_at', 'desc')
            ->where('status', 1)
            ->paginate(8);

        return view('index.document.home', [
            'locale'    => $locale,
            'homepage'  => Homepage::first(),
            'documents' => $documents,
        ]);
    }


    /**
     * @param string   $locale
     * @param Document $document
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowDocumentDetails(string $locale, Document $document)
    {
        return view('index.document.details', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'document' => $document,
        ]);
    }


    /**
     * @param string $locale
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowMusics(string $locale = 'fas')
    {
        $musics = DB::table('music')
            ->orderBy('created_at', 'desc')
            ->where('status', 1)
            ->paginate(8);

        return view('index.music.home', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'musics'   => $musics,
        ]);
    }


    /**
     * @param string $locale
     * @param Music  $music
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ShowMusicDetails(string $locale, Music $music)
    {
        return view('index.music.details', [
            'locale'   => $locale,
            'homepage' => Homepage::first(),
            'music'    => $music,
        ]);
    }


    /**
     * @param string $locale
     * @param News   $news
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAboutUsWithDetails(string $locale)
    {
        return view('index.about_us.home', [
            'locale'   => $locale,
            'homepage' => Homepage::first()
        ]);
    }
}

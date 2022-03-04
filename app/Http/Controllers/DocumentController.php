<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Model\Document;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{

    protected const PATH = 'images/document/';

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
        $documents = DB::table('documents')->paginate(8);
        return view('documents.home', [
            'locale'    => $locale,
            'user'      => $this->helper->getCurrentUser(),
            'documents' => $documents
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
        $document  = new Document();
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $document->user_id     = $user->id;
        $document->title       = $request->get('title');
        $document->description = $request->get('description');
        $document->status      = (bool) $request->get('status');
        $document->save();

        $file = $request->file;
        if ($file) {
            $DocName = $document->id . '.' . $file->extension();
            $fileDoc = self::PATH . $DocName;
            $file->move(self::PATH, $DocName);
        }
        $document->file = $fileDoc;
        $document->save();

        return redirect()->intended(route('document', [$locale, $user]));
    }


    /**
     * @param string   $locale
     * @param Document $document
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $locale, Document $document)
    {
        return view('documents.edit', [
            'locale'   => $locale,
            'user'     => User::where('username', $this->helper->getCurrentUser()),
            'document' => $document
        ]);

    }


    /**
     * @param Request  $request
     * @param string   $locale
     * @param Document $document
     *
     * @return RedirectResponse
     */
    public function update(Request $request, string $locale, Document $document): RedirectResponse
    {
        $user      = $this->helper->getCurrentUser();
        $validator = $this->validator($request, 'nullable');

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $document->user_id     = $user->id;
        $document->title       = $request->get('title');
        $document->description = $request->get('description');
        $document->status      = (bool) $request->get('status');
        $document->save();

        $file = $request->file;

        if ($file) {
            $file->move(self::PATH, $document->file);
        }

        $document->save();

        return redirect()->intended(route('document', [$locale, $user]));
    }


    /**
     * @param string   $locale
     * @param Document $document
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function delete(string $locale, Document $document): RedirectResponse
    {
        if (file_exists($document->file)) {
            unlink($document->file);
        }

        $document->delete();

        return redirect()->intended(route('document', [$locale, $this->helper->getCurrentUser()]));
    }


    /**
     * @param string   $locale
     * @param Document $document
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details(string $locale, Document $document)
    {
        return view('documents.details', [
            'locale'   => $locale,
            'user'     => User::where('username', $this->helper->getCurrentUser()),
            'document' => $document
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
            'file'        => $fileValid . '|file|mimes:ppt,pptx,doc,docx,pdf,xls,xlsx|max:4096',
        ]);
    }
}

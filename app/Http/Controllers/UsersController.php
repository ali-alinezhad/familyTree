<?php

namespace App\Http\Controllers;

use App\Model\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('localization');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($locale)
    {
        return view('users.home');
    }


    /**
     * @param  string  $lang
     * @param  string  $username
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEdit(string $lang, string $username)
    {
        $user = User::where('username', $username)->first();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('users.profile.edit', [
            'profile' => $profile
        ]);
    }


    /**
     * @param  string  $locale
     * @param  Profile  $profile
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(
        string $locale,
        Profile $profile,
        Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'         => 'required|string',
            'birthday'        => 'required|date',
            'birthday_place'  => 'required|string|max:40',
            'residence_place' => 'required|string|max:430',
            'education'       => 'nullable|string|max:40',
            'job_title'       => 'nullable|string|max:50',
            'job_place'       => 'nullable|string|max:40',
            'father_name'     => 'required|string|max:40',
            'mother_name'     => 'required|string|max:40',
            'spouse_name'     => 'required|string|max:40',
            'marriage_date'   => 'nullable|date',
            'marriage_place'  => 'nullable|string|max:40',
            'children_number' => 'nullable|integer|max:20',
            'titles'          => 'nullable|string|max:50',
            'telephone'       => 'nullable|integer',
            'email'           => 'nullable|string|max:50',
            'picture'         => 'nullable|string|max:50',
            'death_date'      => 'nullable|date',
            'death_place'     => 'nullable|string|max:40',
            'burial_place'    => 'nullable|string|max:40'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user = User::where('username', $request->get('user_id'))->first();

        Profile::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'birthday'        => $request->get('birthday'),
                'birthday_place'  => $request->get('birthday_place'),
                'residence_place' => $request->get('residence_place'),
                'education'       => $request->get('education'),
                'job_title'       => $request->get('job_title'),
                'job_place'       => $request->get('job_place'),
                'father_name'     => $request->get('father_name'),
                'mother_name'     => $request->get('mother_name'),
                'spouse_name'     => $request->get('spouse_name'),
                'marriage_date'   => $request->get('marriage_date'),
                'marriage_place'  => $request->get('marriage_place'),
                'children_number' => $request->get('children_number'),
                'titles'          => $request->get('titles'),
                'telephone'       => $request->get('telephone'),
                'email'           => $request->get('email'),
                'picture'         => $request->get('picture'),
                'death_date'      => $request->get('death_date'),
                'death_place'     => $request->get('death_place'),
                'burial_place'    => $request->get('burial_place')
            ]);

        return redirect()->intended(route('home', [$locale]));
    }
}

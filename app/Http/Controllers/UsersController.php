<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Model\Father;
use App\Model\Mother;
use App\Model\Profile;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{

    protected const ADMIN     = 0;
    protected const ASSISTANT = 1;
    protected const USER      = 2;
    protected const PATH      = 'images/users/';

    /**
     * @var Helper
     */
    private $helper;


    /**
     * UsersController constructor.
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
        return view('users.home');
    }


    /**
     * @param string $lang
     * @param string $username
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEdit(string $lang, string $username)
    {
        $fathers     = $mothers = [];
        $currentUser = $this->helper->getCurrentUser();

        $user = ($username !== session()->get('user') && $currentUser
            && ($currentUser->role === self::USER)
        )
            ? $currentUser
            : User::where('username', $username)->first();

        $profile = Profile::where('user_id', $user->id)->first();

        foreach (User::where('username', '<>', 'myAdmin')->get() as $userAsFather) {
            if ($userAsFather->id !== $user->id) {
                if ($userAsFather->status > 0) {
                    $fathers[] = $userAsFather;
                }
                else {
                    $mothers[] = $userAsFather;
                }
            }
        }

        return view('users.profile.edit', [
            'profile' => $profile,
            'user'    => $user,
            'fathers' => $fathers,
            'mothers' => $mothers
        ]);
    }


    /**
     * @param string  $locale
     * @param User    $user
     * @param Profile $profile
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function profileUpdate(
        string  $locale,
        User    $user,
        Profile $profile,
        Request $request
    ): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'status'          => 'nullable|string',
            'birthday'        => 'nullable|date',
            'birthday_place'  => 'nullable|string|max:40',
            'residence_place' => 'nullable|string|max:430',
            'education'       => 'nullable|string|max:40',
            'job_title'       => 'nullable|string|max:50',
            'job_place'       => 'nullable|string|max:40',
            'father_name'     => 'nullable|integer',
            'mother_name'     => 'nullable|string|max:40',
            'spouse_name'     => 'nullable|string|max:40',
            'marriage_date'   => 'nullable|date',
            'marriage_place'  => 'nullable|string|max:40',
            'children_number' => 'nullable|integer|max:20',
            'titles'          => 'nullable|string|max:50',
            'telephone'       => 'nullable|regex:/[0-9]/|max:20',
            'email'           => 'nullable|string|max:50',
            'picture'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_me'        => 'nullable|string',
            'death_date'      => 'nullable|date',
            'death_place'     => 'nullable|string|max:40',
            'burial_place'    => 'nullable|string|max:40',
        ]);

        $fatherId = $request->get('father_name');
        $motherId = $request->get('mother_name');

        if ($fatherId) {
            $children = Father::where('father_id', $user->id)->get();
            foreach ($children as $child) {
                if ($child->user_id === (int) $fatherId) {
                    $validator->after(function ($validator) {
                        $validator->errors()->add('father_name', 'This is your Son!');
                    });
                    break;
                }
            }
        }

        if ($motherId) {
            $children = Mother::where('mother_id', $user->id)->get();
            foreach ($children as $child) {
                if ($child->user_id === (int) $motherId) {
                    $validator->after(function ($validator) {
                        $validator->errors()->add('mother_name', 'This is your Daughter!');
                    });
                    break;
                }
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $picture = $request->picture;

        if ($picture) {
            $imageName = $user->id . '.' . $picture->extension();
            $image     = self::PATH . $imageName;
            $picture->move(self::PATH, $imageName);
        }

        Profile::updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'status'          => (int) $request->get('status'),
                'birthday'        => $request->get('birthday'),
                'birthday_place'  => $request->get('birthday_place'),
                'residence_place' => $request->get('residence_place'),
                'education'       => $request->get('education'),
                'job_title'       => $request->get('job_title'),
                'job_place'       => $request->get('job_place'),
                'father_name'     => $fatherId,
                'mother_name'     => $motherId,
                'spouse_name'     => $request->get('spouse_name'),
                'marriage_date'   => $request->get('marriage_data'),
                'marriage_place'  => $request->get('marriage_place'),
                'children_number' => $request->get('children_number'),
                'titles'          => $request->get('titles'),
                'telephone'       => $request->get('telephone'),
                'email'           => $request->get('email'),
                'picture'         => $image ?? $profile->picture ?? null,
                'about_me'        => $request->get('about_me'),
                'death_date'      => $request->get('death_date'),
                'death_place'     => $request->get('death_place'),
                'burial_place'    => $request->get('burial_place')
            ]
        );

        if ($fatherId) {
            Father::updateOrCreate(['user_id' => $user->id], [
                'user_id'   => $user->id,
                'father_id' => $fatherId,
            ]);
        }

        if ($motherId) {
            Mother::updateOrCreate(['user_id' => $user->id], [
                'user_id'   => $user->id,
                'mother_id' => $motherId,
            ]);
        }

        return redirect()->intended(route('users.profile', [$locale, $user->username]));
    }


    /**
     * @param         $locale
     * @param         $username
     * @param Profile $profile
     *
     * @return RedirectResponse
     */
    public function profileDeleteAvatar($locale, $username, Profile $profile): RedirectResponse
    {
        if (file_exists($profile->picture)) {
            unlink($profile->picture);
        }

        $profile->picture = '';
        $profile->save();

        return redirect()->intended(route('users.profile', [$locale, $username]));
    }


    /**
     * @param string  $locale
     * @param Profile $profile
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function userInfoUpdate(
        string  $locale,
        User    $user,
        Request $request
    )
    {
        $validator = Validator::make($request->all(), [
            'english_name' => 'required|string|max:70',
            'persian_name' => 'required|string|max:70',
            'password'     => 'nullable|min:8|max:20|confirmed',
            'status'       => 'required|string',
        ]);


        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
            $checker        = $request->get('tooltip_check');
            if ($checker === 'Weak' || $checker === 'Min 8 chars') {
                $validator->after(function ($validator) {
                    $validator->errors()->add('password', 'Password is not acceptable');
                });
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user->english_name = $request->get('english_name');
        $user->persian_name = $request->get('persian_name');
        $user->status       = (int) $request->get('status');


        $user->save();

        return redirect()->intended(route('users.profile', [$locale, $user->username]));
    }


    /**
     * @param      $locale
     * @param User $user
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($locale, User $user): RedirectResponse
    {
        if ($user->id > 2) {
            $profile = Profile::where('user_id', $user->id)->first();

            if ($profile && file_exists($profile->picture)) {
                unlink($profile->picture);
            }

            $user->delete();
            $profile->delete();
        }
        return redirect()->intended(route('users', [$locale]));
    }


    /**
     * @param      $locale
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function changeUserRole($locale, User $user): RedirectResponse
    {
        $currentUser = $this->helper->getCurrentUser();

        // Just admin can change the role for others. nobody can change Admin permission even Admin
        if ($user->role !== self::ADMIN && $currentUser->role === self::ADMIN) {
            $user->role === self::ASSISTANT ? ($user->role = self::USER) : ($user->role = self::ASSISTANT);
            $user->save();
        }

        return redirect()->intended(route('users', [$locale]));
    }


    /**
     * @param      $locale
     * @param User $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDetails($locale, User $user)
    {
        $father      = null;
        $mother      = null;
        $currentUser = $this->helper->getCurrentUser();
        $profile     = Profile::where('user_id', $user->id)->first();

        if ($profile) {
            $father = User::where('id', $profile['father_name'])->first();
            $mother = User::where('id', $profile['mother_name'])->first();
        }

        $children = Father::where('father_id', $user->id)->get();

        $kids = [];
        foreach ($children as $child) {
            $kidData = User::where('id', $child->user_id)->first();
            $kids[]  = $kidData->persian_name;
        }

        return view('users.details', [
            'profile'     => $profile,
            'user'        => $user,
            'isSameUser'  => $currentUser->id === $user->id,
            'fatherLinks' => $this->getFatherLinks($locale, $user, $profile),
            'motherLinks' => $this->getMotherLinks($locale, $user, $profile),
            'fatherName'  => $father ? $father->persian_name : '--',
            'motherName'  => $mother ? $mother->persian_name : '--',
            'kids'        => count($kids) ? implode(' - ', $kids) : '--'
        ]);
    }


    /**
     * @param Request $request
     *
     * @return false|string
     */
    public function dataTablesData(Request $request)
    {
        $currentUser = $this->helper->getCurrentUser();
        $users       = User::where('username', '<>', 'myAdmin');
        $totalData   = $users->count();

        $columns = [
            'english_name',
            'persian_name',
            'role',
            'status',
            'action'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = $users
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalData;
        }
        else {
            $search = $request->input('search.value');

            $users = $users->Where('persian_name', 'like', "%{$search}%")
                ->orWhere('english_name', 'like', "%{$search}%");

            $totalFiltered = $users->count();

            $users = $users
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        $data = [];

        if ($users) {
            foreach ($users as $user) {
                $data[] = [
                    'english_name' => $user->english_name,
                    'persian_name' => $user->persian_name,
                    'username'     => ($currentUser->role < self::USER || $currentUser->id === $user->id) ? $user->username
                        : '--',
                    'status'       => $user->status ? trans('translations.man') : trans('translations.woman'),
                    'role'         => '<span class="text-'
                        . ($user->role === self::ADMIN ? 'danger' : ($user->role === self::ASSISTANT ? 'success' : 'info'))
                        . '" data-id="' . $user->id . '">
                            ' . ($user->role === self::ADMIN ? 'Admin' : ($user->role === self::ASSISTANT ? 'Assistant' : 'User'))
                        . '
                        </span>',

                    'action' =>
                        '
                        <a class="btn btn-xs btn-primary" style="float: left;"
                           href="' . route(
                            'users.details',
                            [session()->get('locale') ?? 'fas', $user->id]
                        ) . '" data-toggle="tooltip"
                           data-placement="top">
                            <i class="cil-user" title="Details"></i>
                        </a>' .

                        ($currentUser->role === self::ADMIN || $currentUser->role === self::ASSISTANT ? '
                        <a class="btn btn-xs btn-' .
                            ($user->role === self::ASSISTANT ? 'danger' : 'success') . '
                         change-status-btn"
                           href="' . route(
                                'users.role.change',
                                [session()->get('locale') ?? 'fas', $user->id]
                            )
                            . '" data-toggle="tooltip"
                           data-placement="top" style="float: left;' .

                            ($user->role === self::ADMIN || $currentUser->role !== self::ADMIN ? ' pointer-events: none' : '-') . '
                            ">
                            <i class="' .
                            ($user->role === self::ADMIN ? 'cil-check' : 'cil-star') .
                            '"title="Permission"></i>

                        <a class="btn btn-xs btn-info" style="float: left;"
                           href="' . route('users.profile', [
                                session()->get('locale') ?? 'fas',
                                $user->username
                            ]) . '" data-toggle="tooltip"
                           data-placement="top">
                            <i class="cil-pencil" title="Edit"></i>
                        </a>' .

                            ($user->id > 2 ?

                                '<a class="btn btn-xs btn-danger" style="float: left;" onclick="return confirm(\'Delete this record?\')"
                           href="' . route(
                                    'users.destroy',
                                    [session()->get('locale') ?? 'fas', $user->id]
                                )
                                . '" data-toggle="tooltip"
                           data-placement="top">
                            <i class="cil-trash" title="Delete"></i>
                        </a>' : null) : null),
                ];
            }
        }

        $json_data = [
            'draw'            => (int) ($request->input('draw')),
            'recordsTotal'    => (int) $totalData,
            'recordsFiltered' => (int) $totalFiltered,
            'data'            => $data,
        ];

        return json_encode($json_data);
    }


    /**
     * @param              $locale
     * @param User         $user
     * @param Profile|null $profile
     *
     * @return array
     */
    private function getFatherLinks($locale, User $user, ?Profile $profile): array
    {
        $fatherLinks = [];
        $number      = 0;
        $title       = $user->status ? trans('translations.title_mr') : trans('translations.title_mrs');

        if (empty($profile)) {
            return [];
        }

        $fatherLinks[$title . ' ' . $user->persian_name] = [
            'link'  => route('users.details', [$locale, $user->id]),
            'color' => $profile->status
        ];

        while ($profile && $number < 5) {
            $number++;
            $fatherName = User::where('id', $profile->father_name)->first();
            if ($fatherName) {
                $title   = $fatherName->status ? trans('translations.title_mr') : trans('translations.title_mrs');
                $profile = Profile::where('user_id', $fatherName->id)->first();

                $fatherLinks[$title . ' ' . $fatherName->persian_name] = [
                    'link'  => route('users.details', [$locale, $fatherName->id]),
                    'color' => $profile ? $profile->status : ''
                ];
            }
        }

        return $fatherLinks;
    }


    /**
     * @param              $locale
     * @param User         $user
     * @param Profile|null $profile
     *
     * @return array
     */
    private function getMotherLinks($locale, User $user, ?Profile $profile): array
    {
        $motherLinks = [];
        $number      = 0;
        $title       = $user->status ? trans('translations.title_mr') : trans('translations.title_mrs');

        if (empty($profile)) {
            return [];
        }

        $motherLinks[$title . ' ' . $user->persian_name] = [
            'link'  => route('users.details', [$locale, $user->id]),
            'color' => (int) $profile->status
        ];

        $motherName = User::where('id', $profile->mother_name)->first();
        if (empty($motherName)) {
            return [];
        }

        if ($motherName) {
            $title = $motherName->status ? trans('translations.title_mr') : trans('translations.title_mrs');

            $profile = Profile::where('user_id', $profile->mother_name)->first();

            $motherLinks[$title . ' ' . $motherName->persian_name] = [
                'link'  => route('users.details', [$locale, $profile->user_id]),
                'color' => (int) $profile->status
            ];


        }

        while ($profile && $number < 5) {
            $number++;
            $fatherName = User::where('id', $profile->father_name)->first();
            if ($fatherName) {
                $title = $fatherName->status ? trans('translations.title_mr') : trans('translations.title_mrs');

                $motherLinks[$title . ' ' . $fatherName->persian_name] = [
                    'link'  => route('users.details', [$locale, $profile->father_name]),
                    'color' => (int) $profile->status
                ];

                $profile = Profile::where('user_id', $profile->father_name)->first();
            }
        }


        return $motherLinks;
    }
}

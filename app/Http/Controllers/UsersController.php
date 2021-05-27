<?php

namespace App\Http\Controllers;

use App\Model\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    protected const ADMIN = 1;
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
    public function index($locale,Request $request)
    {
        $users = User::select();

        $totalData = $users->count();

        $columns = [
            'english_name',
            'persian_name',
            'role',
            'status',
            'created_at',
            'updated_at'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
      //  $order = $columns[$request->input('order.0.column')];
     //   $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = $users
                ->limit($limit)
              //  ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalData;
        } else {
            $search = $request->input('search.value');

            $users = $users
                ->Where('hosts.english_name', 'like', "%{$search}%");
//                ->orWhere('hosts.status', 'like', "%{$search}%")
//                ->orWhere('countries.name', 'like', "%{$search}%")
//                ->orWhere('hosts.custom_tag', 'like', "%{$search}%")
//                ->orWhere('hosts.external_host_tag', 'like', "%{$search}%")
//                ->orWhere('topics.name', 'like', "%{$search}%");

            $totalFiltered = $users->count();

            $users = $users
             //   ->offset($start)
                ->limit($limit)
             //   ->orderBy($order, $dir)
                ->get();
        }

      //  dd($users);



        session()->put('user', $request->user()->username);
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
        $activeUser  = session()->get('user');
        $currentUser = User::where('username', $activeUser)->first();

        $user = ($username !== $activeUser && $currentUser->role !== self::ADMIN) ?
            $currentUser :
            User::where('username', $username)->first();

        $profile = Profile::where('user_id', $user->id)->first();

        return view('users.profile.edit', [
            'profile' => $profile,
            'user'    => $user
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
        User $user,
        Profile $profile,
        Request $request)
    {
        $validator = Validator::make($request->all(), [
            'birthday'        => 'nullable|date',
            'birthday_place'  => 'nullable|string|max:40',
            'residence_place' => 'required|string|max:430',
            'education'       => 'nullable|string|max:40',
            'job_title'       => 'nullable|string|max:50',
            'job_place'       => 'nullable|string|max:40',
            'father_name'     => 'nullable|string|max:40',
            'mother_name'     => 'nullable|string|max:40',
            'spouse_name'     => 'nullable|string|max:40',
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


    /**
     * @param  string  $locale
     * @param  Profile  $profile
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userInfoUpdate(
        string $locale,
        User $user,
        Request $request)
    {
        $validator = Validator::make($request->all(), [
            'english_name'     => 'required|string|max:70',
            'persian_name'     => 'required|string|max:70',
            'password'         => 'nullable|min:8|max:20|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $user->english_name = $request->get('english_name');
        $user->persian_name = $request->get('persian_name');

        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        return redirect()->intended(route('home', [$locale]));
    }



    public function destroy($locale, User $user)
    {
        dd($user);
    }


    public function changeUserRole($locale, User $user)
    {
        dd($user);
    }


    public function dataTablesData(Request $request)
    {
        $users = User::select();

        $totalData = $users->count();

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
        } else {
            $search = $request->input('search.value');

            $users = $users
                ->Where('persian_name', 'like', "%{$search}%");
//                ->orWhere('hosts.status', 'like', "%{$search}%")
//                ->orWhere('countries.name', 'like', "%{$search}%")
//                ->orWhere('hosts.custom_tag', 'like', "%{$search}%")
//                ->orWhere('hosts.external_host_tag', 'like', "%{$search}%")
//                ->orWhere('topics.name', 'like', "%{$search}%");

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
                    'status'       => $user->status,
                    'role'         => $user->role,
                    'action'       => '
                        <a class="btn btn-xs btn-success" style="float: left;"
                           href="' . route('users.role.change', [session()->get('locale') ?? 'fas',$user->id]) . '" data-toggle="tooltip"
                           data-placement="top">
                            <i class="cil-check" title="Edit"></i>
                        </a>
                        <a class="btn btn-xs btn-info" style="float: left;"
                           href="' . route('users.profile', [session()->get('locale') ?? 'fas',$user->username]) . '" data-toggle="tooltip"
                           data-placement="top">
                            <i class="cil-pencil" title="Edit"></i>
                        </a>
                         ' . \Form::open(['route'=>['users.destroy',[session()->get('locale') ?? 'fas', $user->id]], 'method' => 'delete', 'style' => 'display: inline; float: left;']) . '
                            <button class="btn btn-xs btn-danger user_destroy">
                                <i class="cil-trash" title="Delete"></i>
                            </button>
                        ' . \Form::close() . '
                    ',
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
}

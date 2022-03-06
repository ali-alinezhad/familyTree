<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'english_name' => ['required', 'string', 'max:255'],
            'persian_name' => ['required', 'string', 'max:255'],
            'status'       => ['required', 'string'],
            'username'     => ['string', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(array $data)
    {
        $userName = $this->createUserName($data['english_name']);

        return User::create([
            'english_name' => $data['english_name'],
            'persian_name' => $data['persian_name'],
            'status'       => (int)$data['status'],
            'username'     => $userName,
            'password'     => Hash::make($data['password']),
        ]);
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        new Registered($this->create($request->all()));

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }


    /**
     * @param  string  $name
     *
     * @return string
     */
    private function createUserName(string $name): string
    {
        $lastUserId = User::max('id');

        $userName = strtolower(trim($name));

        // for example shahab.espahbodi1
        return str_replace(' ', '.', $userName) . ++$lastUserId;
    }
}

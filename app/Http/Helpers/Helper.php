<?php


namespace App\Http\Helpers;


use App\User;

class Helper
{
    /**
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        $activeUser  = session()->get('user');
        return User::where('username', $activeUser)->first();
    }

}

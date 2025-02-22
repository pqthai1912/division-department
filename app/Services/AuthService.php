<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(Request $request)
    {
        // return 1 : pass, 0: fail
        return Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ]) ? 1 : 0;
    }

    // check email has already existed
    public function emailExists($user)
    {
        // if email already exists on db -> accept for login
        if ($user) {
            return "true";
        }

        return "false";

    }

}

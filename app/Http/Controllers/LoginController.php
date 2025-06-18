<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(Request $req)
    {

        $credentials = $req->only('user_id', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $userId = Auth::id();
            $userRole = $user->role;
            $userName = $user->surname . ', ' . $user->firstname;
            $userPhoto = '/images/administrators/' . $user->photo;

            if ($userRole != 0) {

                Auth::logout();

                return redirect()->back()->withErrors([
                    'message' => 'Account invalid!',
                ]);
            }

            $req->session()->put('administrator', $userId);
            $req->session()->put('role', $userRole);
            $req->session()->put('name', $userName);
            $req->session()->put('photo', $userPhoto);

            // Authentication passed...
            return redirect('/dashboard');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Username or password invalid!',
            ]);
        }
    }
}

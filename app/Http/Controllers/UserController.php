<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function changeData(Request $request)
    {
        $user = User::where('id', '=', Auth::id())->first();
        if($request->input('password') != '')
        {
            $request->validate([
                'password' => ['required', 'string', 'min:8'],
            ]);
            $user->password = $request->input('password');
        }
        if($request->input('nickname') != $user->nickname)
        {
            $request->validate([
                'nickname' => ['required', 'string', 'max:20', 'unique:User'],
            ]);
            $user->nickname = $request->input('nickname');
        }
        if($request->input('email') != $user->email)
        {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:100', 'unique:User'],
            ]);
            $user->email = $request->input('email');
        }
        $user->save();
        return redirect(RouteServiceProvider::HOME);
    }
}

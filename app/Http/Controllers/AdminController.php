<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function changeStatus(Request $request)
    {
        $nickname = $request->input('nickname');
        $user = User::where('nickname', '=', $nickname)->first();
        if(!$user) {
            throw ValidationException::withMessages([
                'noUser' => 'nickname not found'
            ]);
        }
        if($request->input('action') === 'seller')
        {
            $user->is_seller = !$user->is_seller;
            $user->save();
        }
        elseif ($request->input('action') === 'admin')
        {
            $user->is_admin = !$user->is_admin;
            $user->save();
        }
        else
        {
            User::where('id', $user->id)->delete();
        }
        return redirect()->back();
    }
}

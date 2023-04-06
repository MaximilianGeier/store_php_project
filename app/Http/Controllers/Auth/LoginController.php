<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    function createAccount()
    {
        return view('login');
    }

    /**
     * @throws ValidationException
     */
    function storeAccount(Request $request)
    {
        $credentials = $request->validate([
            'nickname' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember')))
        {
            throw ValidationException::withMessages([
                'nickname' => 'uncorrected nickname or password'
            ]);
        }

        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}

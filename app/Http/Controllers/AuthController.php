<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // validate request
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // get credentials for login
        $credentials = $request->only('email', 'password');

        // attempt authentication
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return to_route('category',['category'=>'category']);
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        //save new user to database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // authenticate new user
        Auth::login($user);

        return to_route('category',['category'=>'category']);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // delete sessions and logout user
        Session::flush();
        Auth::logout();

        return to_route('login');
    }
}

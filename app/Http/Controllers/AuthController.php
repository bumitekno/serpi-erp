<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('welcome');
    }

    /** store auth */
    public function Authen(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (empty($user)) {
            return response()->json(['message' => 'Email  ' . $request->input('email') . '  not register at our database', 'redirect' => route('login')], 400);
        }

        $password = $request->input('password');
        if (!Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Your provided credentials do not match in our records.', 'redirect' => route('login')], 400);
        }

        $request->session()->regenerate();
        Auth::login($user);
        Auth::user()->last_login = new \DateTime();
        Auth::user()->save();
        return response()->json(['message' => 'You have successfully logged in', 'redirect' => route('dashboard')], 200);

    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}

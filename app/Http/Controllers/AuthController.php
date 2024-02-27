<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SettingApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Contracts\Activity;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $setting = SettingApp::latest()->first();
        if (!empty($setting)) {
            if (!empty($setting->title))
                Session::put('title_web', $setting->title);

            if (!empty($setting->keyword))
                Session::put('keyword_web', $setting->keyword);

            if (!empty($setting->description))
                Session::put('description_web', $setting->description);

            if (!empty($setting->logo))
                Session::put('logo', $setting->logo);

            if (!empty($setting->footer))
                Session::put('footer_web', $setting->footer);
        }
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

        activity()
            ->causedBy($user->id)
            ->performedOn($user)
            ->tap(function (Activity $activity) use ($user) {
                $activity->log_name = ' User ' . $user->name . ' Login to system ';
            })
            ->withProperties(['name' => $user->name])
            ->event('login')
            ->log('login');
        return response()->json(['message' => 'You have successfully logged in', 'redirect' => route('home.addons')], 200);
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $userModel = Auth::user()->id;
        $user = User::find($userModel);
        activity()
            ->causedBy($userModel)
            ->performedOn($user)
            ->tap(function (Activity $activity) use ($user) {
                $activity->log_name = ' User ' . $user->name . ' Logout from system ';
            })
            ->withProperties(['name' => $user->name])
            ->event('logout')
            ->log('logout');

        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}

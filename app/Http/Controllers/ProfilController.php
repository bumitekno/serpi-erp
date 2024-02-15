<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profil')->with(['user' => $user]);
    }

    /** store update */
    public function storeupdate(Request $request)
    {
        $input = $request->all();

        $user = User::find(Auth::user()->id);

        if (!empty($request->password)) {
            $input['password'] = Hash::make($request->password);
        } else {
            $input = $request->except('password');
        }

        if ($request->hasFile('avatar')) {

            if (!empty($user->avatar)) {
                if (Storage::exists($user->avatar))
                    Storage::delete($user->avatar);
            }
            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/photo/profiles', $imageName, 'public');
            $input['avatar'] = $path;
        }

        $user->update($input);

        return redirect()->back()
            ->withSuccess('User is updated successfully.');
    }
}

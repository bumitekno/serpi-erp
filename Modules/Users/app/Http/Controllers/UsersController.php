<?php

namespace Modules\Users\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Modules\Users\app\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_user = User::query()->get();
        $roles = Role::pluck('name', 'name')->all();
        return view('users::index')->with(['list_user' => $list_user, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirmpassword',
            'user_role' => 'required',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $data_send = [
            'name' => $input['user_name'],
            'email' => $input['user_email'],
            'password' => $input['password']
        ];

        if ($request->hasFile('avatar')) {
            $imageName = time() . '.' . $request->avatar->extension();
            $path = $request->file('avatar')->storeAs('/upload/photo/profiles', $imageName, 'public');
            $data_send['avatar'] = $path;
        }

        $user = User::create($data_send);

        $user->assignRole($request->input('user_role'));
        $permissions = Permission::pluck('id', 'id')->all();
        $user->syncPermissions($permissions);

        return response()->json(['message' => 'User created successfully', 'redirect' => route('users.index')], 200);

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users::show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        if ($user->hasRole('Superadmin')) {
            if ($user->id != Auth::user()->id) {
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }

        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name')->all();
        return view('users::edit')->with(['user' => $user, 'roles' => $roles, 'userRole' => $userRole]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        //

        $input = $request->all();

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

        $user->syncRoles($request->roles);

        return redirect()->back()
            ->withSuccess('User is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        if (Auth::user()->id == $id) {
            return response()->json(['message' => Auth::user()->name . ' can`t delete it , because it is user login ', 'redirect' => route('users.index')], 400);
        }

        $user = User::find($id);
        if (!empty($user)) {

            // About if user is Super Admin or User ID belongs to Auth User
            if ($user->hasRole('Superadmin') || $user->id == Auth::user()->id) {
                return response()->json(['message' => 'USER DOES NOT HAVE THE RIGHT PERMISSIONS', 'redirect' => route('users.index')], 403);
            }

            $user->syncRoles([]);

            if (!empty($user->avatar)) {
                if (Storage::disk('public')->exists($user->avatar))
                    Storage::disk('public')->delete($user->avatar);
            }
            $user->delete();
            return response()->json(['message' => 'User Delete successfully', 'redirect' => route('users.index')], 200);
        }

        return response()->json(['message' => 'User Delete ERROR', 'redirect' => route('users.index')], 400);
    }

    /**
     * Remove multiple the specified resource from storage.
     */

    public function destroy_multiple(Request $request)
    {
        $error = false;
        foreach ($request->user_id as $ls) {
            if (Auth::user()->id == $ls) {
                $error = true;
                break;
            } else {
                $user = User::find($ls);
                if (!empty($user)) {
                    if (!empty($user->avatar)) {
                        if (Storage::disk('public')->exists($user->avatar))
                            Storage::disk('public')->delete($user->avatar);
                    }
                    // About if user is Super Admin or User ID belongs to Auth User
                    if ($user->hasRole('Superadmin') || $user->id == auth()->user()->id) {
                        abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
                    }
                    $user->syncRoles([]);
                    $user->delete();
                }
            }
        }

        if ($error == true) {
            return response()->json(['message' => Auth::user()->name . ' can`t delete it , because it is user login ', 'redirect' => route('users.index')], 400);
        } else {
            return response()->json(['message' => 'User Delete successfully', 'redirect' => route('users.index')], 200);
        }
    }

}

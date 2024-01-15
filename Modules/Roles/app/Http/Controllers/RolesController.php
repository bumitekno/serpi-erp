<?php

namespace Modules\Roles\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Modules\Roles\app\Http\Requests\UpdateRoleRequest;
use Modules\Roles\app\Http\Requests\StoreRoleRequest;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create-role|edit-role|delete-role', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles::index')->with(['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles::create')->with([
            'group_modules' => Permission::select('group_modules')->distinct()->orderBy('group_modules')->get()->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        //
        $role = Role::create(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();

        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')
            ->withSuccess('New role is added successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles::show')->with([
            'role' => $role,
            'group_modules' => Permission::select('group_modules')->distinct()->orderBy('group_modules')->get()->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if ($role->name == 'Superadmin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE EDITED');
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_id", $role->id)
            ->pluck('permission_id')
            ->all();

        return view('roles::edit', [
            'role' => $role,
            'group_modules' => Permission::select('group_modules')->distinct()->orderBy('group_modules')->get()->toArray(),
            'rolePermissions' => $rolePermissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        //
        $input = $request->only('name');

        $role->update($input);

        $permissions = Permission::whereIn('id', $request->permissions)->get(['name'])->toArray();

        $role->syncPermissions($permissions);

        return redirect()->back()
            ->withSuccess('Role is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        if ($role->name == 'Superadmin') {
            abort(403, 'SUPER ADMIN ROLE CAN NOT BE DELETED');
        }
        if (auth()->user()->hasRole($role->name)) {
            abort(403, 'CAN NOT DELETE SELF ASSIGNED ROLE');
        }
        $role->delete();
        return redirect()->route('roles.index')
            ->withSuccess('Role is deleted successfully.');
    }
}

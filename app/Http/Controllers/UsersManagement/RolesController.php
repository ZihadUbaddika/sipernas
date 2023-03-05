<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleMassDestroyReq;
use App\Http\Requests\Role\RoleStoreReq;
use App\Http\Requests\Role\RoleUpdateReq;
use App\Models\UserManagement\Permission;
use App\Models\UserManagement\Role;
use Illuminate\Support\Facades\Gate;


class RolesController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('role_access'), 403);

        $roles = Role::all();

        return view('dashboard.admin.users_management.roles.index', compact('roles'));
    }

    public function create()
    {
        abort_unless(Gate::allows('role_create'), 403);

        $permissions = Permission::all()->pluck('title', 'id');

        return view('dashboard.admin.users_management.roles.create', compact('permissions'));
    }

    public function store(RoleStoreReq $request)
    {
        abort_unless(Gate::allows('role_create'), 403);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('dashboard.admin.users_management.roles.index');
    }

    public function edit(Role $role)
    {
        abort_unless(Gate::allows('role_edit'), 403);

        $permissions = Permission::all()->pluck('title', 'id');

        $role->load('permissions');

        return view('dashboard.admin.users_management.roles.edit', compact('permissions', 'role'));
    }

    public function update(RoleUpdateReq $request, Role $role)
    {
        abort_unless(Gate::allows('role_edit'), 403);
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('dashboard.admin.users_management.roles.index');
    }

    public function show(Role $role)
    {
        abort_unless(Gate::allows('role_show'), 403);

        $role->load('permissions');

        return view('dashboard.admin.users_management.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_unless(Gate::allows('role_delete'), 403);

        $role->delete();

        return back();
    }

    public function massDestroy(RoleMassDestroyReq $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}

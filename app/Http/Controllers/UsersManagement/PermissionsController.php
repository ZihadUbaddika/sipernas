<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionMassDestroyReq;
use App\Http\Requests\Permission\PermissionStoreReq;
use App\Http\Requests\Permission\PermissionUpdateReq;
use App\Models\UserManagement\Permission;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('permission_access'), 403);

        $permissions = Permission::all();

        return view('dashboard.admin.users_management.permissions.index', compact('permissions'));
    }

    public function create()
    {
        abort_unless(Gate::allows('permission_create'), 403);

        return view('dashboard.admin.users_management.permissions.create');
    }

    public function store(PermissionStoreReq $request)
    {
        abort_unless(Gate::allows('permission_create'), 403);

        $permission = Permission::create($request->all());

        return redirect()->route('dashboard.admin.users_management.permissions.index');
    }

    public function edit(Permission $permission)
    {
        abort_unless(Gate::allows('permission_edit'), 403);

        return view('dashboard.admin.users_management.permissions.edit', compact('permission'));
    }

    public function update(PermissionUpdateReq $request, Permission $permission)
    {
        abort_unless(Gate::allows('permission_edit'), 403);

        $permission->update($request->all());

        return redirect()->route('dashboard.admin.users_management.permissions.index');
    }

    public function show(Permission $permission)
    {
        abort_unless(Gate::allows('permission_show'), 403);

        return view('dashboard.admin.users_management.permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        abort_unless(Gate::allows('permission_delete'), 403);

        $permission->delete();

        return back();
    }

    public function massDestroy(PermissionMassDestroyReq $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}

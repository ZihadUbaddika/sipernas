<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserMassDestroyReq;
use App\Http\Requests\User\UserStoreReq;
use App\Http\Requests\User\UserUpdateReq;
use App\Models\UserManagement\Kepegawaian;
use Illuminate\Support\Facades\Gate;
use App\Models\UserManagement\Role;
use App\Models\UserManagement\User;

class UsersController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('user_access'), 403);

        $users = User::all();

        return view('dashboard.admin.users_management.users.index', compact('users'));
    }

    public function create()
    {
        abort_unless(Gate::allows('user_create'), 403);

        $roles = Role::all()->pluck('title', 'id');
        $kepegawaian_id = Kepegawaian::whereNotIn('id',function($query){
            $query->select('kepegawaian_id')->from('users');
            })->pluck('email','id');
        return view('dashboard.admin.users_management.users.create', compact('roles','kepegawaian_id'));
    }

    public function store(UserStoreReq $request)
    {
        abort_unless(Gate::allows('user_create'), 403);
        $user = User::create([
            'kepegawaian_id' =>$request->kepegawaian_id,
            'email' =>$request->email,
            'password' =>$request->password,
        ]);
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('dashboard.admin.users_management.users.index');
    }

    public function edit(User $user)
    {
        abort_unless(Gate::allows('user_edit'), 403);
        $kepegawaian_id = Kepegawaian::pluck('email','id');
        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('dashboard.admin.users_management.users.edit', compact('roles', 'user', 'kepegawaian_id'));
    }

    public function update(UserUpdateReq $request, User $user)
    {
        abort_unless(Gate::allows('user_edit'), 403);

        if($request->change_password){
            $user->update([
                'kepegawaian_id'    =>$request->kepegawaian_id,
                'email'      =>$request->email,
                'password'   =>$request->password,
            ]);
        }else{
            $user->update([
                'name'    =>$request->name,
                'email'      =>$request->email,
            ]);
        }
        $notification = array(
            'message' => 'Data pengguna berhasil diperbarui!',
            'alert-type' => 'success',
        );
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('dashboard.admin.users_management.users.index')->with($notification);
    }

    public function show(User $user)
    {
        abort_unless(Gate::allows('user_show'), 403);

        $user->load('roles');

        return view('dashboard.admin.users_management.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_unless(Gate::allows('user_delete'), 403);

        $user->delete();

        return back();
    }

    public function massDestroy(UserMassDestroyReq $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}

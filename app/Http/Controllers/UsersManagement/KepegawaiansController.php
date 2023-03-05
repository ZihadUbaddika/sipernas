<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kepegawaian\KepegawaianMassDestroyReq;
use App\Http\Requests\Kepegawaian\KepegawaianStoreReq;
use App\Http\Requests\Kepegawaian\KepegawaianUpdateReq;
use App\Models\UserManagement\Kepegawaian;
use Illuminate\Support\Facades\Gate;
use App\Models\UserManagement\User;
use Carbon\Carbon;

class KepegawaiansController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('kepegawaian_access'), 403);
    
        $kepegawaians = Kepegawaian::all();
        return view('dashboard.admin.users_management.kepegawaians.index', compact('kepegawaians'));
    }

   
    public function create()
    {
        abort_unless(Gate::allows('kepegawaian_create'), 403);
        $data_user = User::pluck('email','id');
        return view('dashboard.admin.users_management.kepegawaians.create',compact('data_user'));
    }
    
    public function store(KepegawaianStoreReq $request)
    {
        abort_unless(Gate::allows('kepegawaian_create'), 403);
        $get_file = $request->file('foto');
		$file_name = time()."_".$get_file->getClientOriginalName();
		$upload_to = 'profile_photo';
        $get_file->move($upload_to,$file_name);
        Kepegawaian::create([
            'nama'                  =>$request->nama,
            'nip'                   =>$request->nip,
            'pangkat'               =>$request->pangkat,
            'golongan'              =>$request->golongan,
            'foto'                  =>$file_name,
            'email'                 =>$request->email,
            'no_hp'                 =>$request->no_hp,
        ]);
        $notification = array(
            'message' => 'Pegawai berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard.admin.users_management.kepegawaians.index')->with($notification);
    }
    
    public function edit(Kepegawaian $kepegawaian)
    {
        abort_unless(Gate::allows('kepegawaian_edit'), 403);
        $data_user = User::pluck('email','id');
        return view('dashboard.admin.users_management.kepegawaians.edit', compact('data_user','kepegawaian'));
    }
    
    public function update(KepegawaianUpdateReq $request, Kepegawaian $kepegawaian)
    {
        abort_unless(Gate::allows('kepegawaian_edit'), 403);
        if($request->change_foto){
            $get_file = $request->file('foto');
            $file_name = time()."_".$get_file->getClientOriginalName();
            $upload_to = 'profile_photo';
            $get_file->move($upload_to,$file_name);
            $kepegawaian->update([
                'nama'                  =>$request->nama,
                'nip'                   =>$request->nip,
                'pangkat'               =>$request->pangkat,
                'golongan'              =>$request->golongan,
                'foto'                  =>$file_name,
                'email'                 =>$request->email,
                'no_hp'                 =>$request->no_hp,
            ]);
        }else{
            $kepegawaian->update([
                'nama'                  =>$request->nama,
                'nip'                   =>$request->nip,
                'pangkat'               =>$request->pangkat,
                'golongan'              =>$request->golongan,
                'email'                 =>$request->email,
                'no_hp'                 =>$request->no_hp,
            ]);
        }
        $notification = array(
            'message' => 'kepegawaian berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard.admin.users_management.kepegawaians.index')->with($notification);
    }
    
    public function show(Kepegawaian $kepegawaian)
    {
        abort_unless(Gate::allows('kepegawaian_show'), 403);
    
        return view('dashboard.admin.users_management.kepegawaians.show', compact('kepegawaian'));
    }
    
    public function destroy(Kepegawaian $kepegawaian)
    {
        abort_unless(Gate::allows('kepegawaian_delete'), 403);
        unlink("profile_photo/".$kepegawaian->foto);
        $kepegawaian->delete();

        return back();
    }
    
    public function massDestroy(KepegawaianMassDestroyReq $request)
    {
        Kepegawaian::whereIn('id', request('ids'))->delete();
    
        return response(null, 204);
    }
}

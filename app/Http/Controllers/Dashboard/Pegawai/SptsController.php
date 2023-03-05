<?php

namespace App\Http\Controllers\Dashboard\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SptsController extends Controller
{
    protected $user_id, $wilayah_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = $request->user()->id;
            $this->wilayah_id = $request->user()->roles[0]->wilayah_id;
            return $next($request);
        });
    }
    public function index()
    {
        abort_unless(Gate::allows('is_pegawai'), 403);
        $user_id = $this->user_id;
        $spts = Pengajuan::where([
            ['wilayah', '=', $this->wilayah_id],
            ['status_pengajuan', 'disetujui_inspektur'],
        ])->where(function ($query) {
            $query->where('penanggung_jawab', $this->user_id)
                ->orWhere('supervisor', $this->user_id)
                ->orWhere('ketua_tim', $this->user_id)
                ->orWhere(function ($another_query) {
                    $another_query->whereHas('anggota', function ($q) {
                        $q->where('user_id', $this->user_id);
                    });
                });
        })->get();
        return view('dashboard.pegawai.spts.index', compact('spts','user_id'));
    }
    public function cetak_spt($id, Request $request)
    {
        abort_unless(Gate::allows('spt_access') || Gate::allows('pengajuan_create'), 403);
        return Pengajuan::cetak_spt($id,$request->paraf);
    }
}

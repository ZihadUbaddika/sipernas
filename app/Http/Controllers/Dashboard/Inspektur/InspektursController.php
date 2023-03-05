<?php

namespace App\Http\Controllers\Dashboard\Inspektur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class InspektursController extends Controller
{
    protected $user_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = $request->user()->id;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        abort_unless(Gate::allows('is_inspektur'), 403);
        $wilayah_id = strtolower($request->wilayah_id);
        if ($request->wilayah_id == null || $wilayah_id == "semua") {
            $perlu_disetujui = Pengajuan::where('status_pengajuan', 'disetujui_irban')
                ->get();
            $diterima = Pengajuan::where('status_pengajuan', 'disetujui_inspektur')
                ->get();
            $ditolak = Pengajuan::whereIn('status_pengajuan', ['ditolak_irban', 'ditolak_inspektur'])
                ->get();
            $wilayah_id = "semua";
        } else {
            $perlu_disetujui = Pengajuan::where('wilayah', $wilayah_id)
                ->where('status_pengajuan', 'disetujui_irban')
                ->get();
            $diterima = Pengajuan::where('wilayah', $wilayah_id)
                ->where('status_pengajuan', 'disetujui_inspektur')
                ->get();
            $ditolak = Pengajuan::where('wilayah', $wilayah_id)->whereIn('status_pengajuan', ['ditolak_irban', 'ditolak_inspektur'])
                ->get();
        }
        return view('dashboard.inspektur.pengajuans.index', compact('perlu_disetujui', 'diterima', 'ditolak', 'wilayah_id'));
    }
    public function spts(Request $request)
    {
        abort_unless(Gate::allows('is_inspektur'), 403);
        $wilayah_id = strtolower($request->wilayah_id);
        if ($request->wilayah_id == null || $wilayah_id == "semua") {
            $spts =  $this->selectSpt('penanggung_jawab', $this->user_id,'semua');
            $wilayah_id = "semua";
        }else{
            $spts =  $this->selectSpt('penanggung_jawab', $this->user_id,$wilayah_id);
        }
        return view('dashboard.inspektur.spts.index', compact('spts','wilayah_id'));
    }

    public function programkegiatan(Request $request)
    {
        abort_unless(Gate::allows('is_inspektur'), 403);
        $user_id = $this->user_id;
        $wilayah_id = strtolower($request->wilayah_id);
        if ($request->wilayah_id == null || $wilayah_id == "semua") {
            $programkegiatans = Pengajuan::where([
                ['penanggung_jawab', $this->user_id],
                ['no_spt', '!=', null],
                ['no_lhp', '=', null],
                ['status_pengajuan', 'disetujui_inspektur'],
            ])->get();
        }else{
            $programkegiatans = Pengajuan::where([
                ['penanggung_jawab', $this->user_id],
                ['wilayah', $wilayah_id],
                ['no_spt', '!=', null],
                ['no_lhp', '=', null],
                ['status_pengajuan', 'disetujui_inspektur'],
            ])->get();
        }
        
        return view('dashboard.inspektur.programkegiatans.index', compact('programkegiatans','user_id','wilayah_id'));
    }
    public function riwayat(Request $request)
    {
        abort_unless(Gate::allows('is_inspektur'), 403);
        $user_id = $this->user_id;
        $wilayah_id = strtolower($request->wilayah_id);
        if ($request->wilayah_id == null || $wilayah_id == "semua") {
            $programkegiatans = Pengajuan::where([
                ['penanggung_jawab', $this->user_id],
                ['no_spt', '!=', null],
                ['no_lhp', '!=', null],
                ['status_pengajuan', 'disetujui_inspektur'],
            ])->get();
        }else{
            $programkegiatans = Pengajuan::where([
                ['penanggung_jawab', $this->user_id],
                ['wilayah', $wilayah_id],
                ['no_spt', '!=', null],
                ['no_lhp', '!=', null],
                ['status_pengajuan', 'disetujui_inspektur'],
            ])->get();
        }
        
        return view('dashboard.inspektur.programkegiatans.riwayat', compact('programkegiatans','user_id','wilayah_id'));
    }

    public function submit(Request $request, $id)
    {
        abort_unless(Gate::allows('pengajuan_access') and Gate::allows('is_inspektur'), 403);
        $pengajuan = Pengajuan::find($id);
        if ($request->status_pengajuan == "terima") {
            $pengajuan->update([
                'status_pengajuan'    => 'disetujui_inspektur',
            ]);
        } else if ($request->status_pengajuan == "tolak") {
            $pengajuan->update([
                'status_pengajuan'    => 'ditolak_inspektur',
                'keterangan_pengajuan'    => $request->keterangan_pengajuan,
            ]);
        } else {
            return back();
        }
        return back();
    }

    public function show($id)
    {
        abort_unless(Gate::allows('pengajuan_show') and Gate::allows('is_inspektur'), 403);
        $pengajuan = Pengajuan::find($id);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $pengajuan->load('dasar');
        $pengajuan->load('anggota');
        return view('dashboard.inspektur.pengajuans.show', compact('pengajuan', 'jml_hari'));
    }
    public function showprogramkegiatan($id)
    {
        abort_unless(Gate::allows('pengajuan_show') and Gate::allows('is_inspektur'), 403);
        $pengajuan = Pengajuan::find($id);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $pengajuan->load('dasar');
        $pengajuan->load('anggota');
        return view('dashboard.inspektur.programkegiatans.show', compact('pengajuan', 'jml_hari'));
    }

    public function cetak_notadinas($id)
    {
        abort_unless(Gate::allows('pengajuan_show'), 403);
        return Pengajuan::cetak_notadinas($id);
    }
    public function download_lhp($id)
    {
        abort_unless(Gate::allows('is_inspektur'), 403);
        $pengajuan = Pengajuan::find($id);
        $file = public_path()."/berkas_lhp/$id/$pengajuan->berkas";
    	$headers = ['Content-Type: application/pdf'];
        
    	return response()->download($file, $pengajuan->berkas, $headers);
    }
    public function cetak_spt($id, Request $request)
    {
        abort_unless(Gate::allows('is_inspektur'), 403);
        return Pengajuan::cetak_spt($id,$request->paraf);
    }
    private function selectSpt($level, $uid,$wilayah)
    {
        if($wilayah == 'semua'){
            $data_spts = Pengajuan::where($level,$uid)
            ->where('no_spt', '!=', null)
            ->where('status_pengajuan', 'disetujui_inspektur')
            ->select('id', 'supervisor', 'wilayah', 'objek', 'no_spt', 'tgl_terbit', 'nama_kegiatan', 'no_lhp')->get();
        }else{
            $data_spts = Pengajuan::where($level,$uid)
            ->where('wilayah', '=', $wilayah)
            ->where('no_spt', '!=', null)
            ->where('status_pengajuan', 'disetujui_inspektur')
            ->select('id', 'supervisor', 'wilayah', 'objek', 'no_spt', 'tgl_terbit', 'nama_kegiatan', 'no_lhp')->get();
        }

        return $data_spts;
    }
}

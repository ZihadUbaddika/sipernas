<?php

namespace App\Http\Controllers\Dashboard\Irban;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Pengajuan;
use App\Models\UserManagement\User;
use Illuminate\Http\Request;

class IrbansController extends Controller
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
        abort_unless(Gate::allows('is_irban'), 403);
        $perlu_disetujui =  $this->selectPengajuan('disubmit');
        $sudah_disetujui =  $this->selectPengajuan('disetujui_irban');
        $diterima =  $this->selectPengajuan('disetujui_inspektur');
        $ditolak =  $this->selectPengajuan(['ditolak_irban', 'ditolak_inspektur']);
        return view('dashboard.irban.pengajuans.index', compact('perlu_disetujui', 'sudah_disetujui', 'diterima', 'ditolak'));
    }
    public function spts()
    {
        abort_unless(Gate::allows('is_irban'), 403);
        $spts =  $this->selectSpt('supervisor', $this->user_id);
        return view('dashboard.irban.spts.index', compact('spts'));
    }
    public function programkegiatan()
    {
        abort_unless(Gate::allows('is_irban'), 403);
        $user_id = $this->user_id;
        $programkegiatans = Pengajuan::where([
            ['supervisor', $this->user_id],
            ['wilayah', '=', $this->wilayah_id],
            ['no_spt', '!=', null],
            ['no_lhp', '=', null],
            ['status_pengajuan', 'disetujui_inspektur'],
        ])->get();
        return view('dashboard.irban.programkegiatans.index', compact('programkegiatans','user_id'));
    }
    public function riwayat()
    {
        abort_unless(Gate::allows('is_irban'), 403);
        $user_id = $this->user_id;
        $programkegiatans = Pengajuan::where([
            ['supervisor', $this->user_id],
            ['wilayah', '=', $this->wilayah_id],
            ['no_spt', '!=', null],
            ['no_lhp', '!=', null],
            ['status_pengajuan', 'disetujui_inspektur'],
        ])->get();
        return view('dashboard.irban.programkegiatans.riwayat', compact('programkegiatans','user_id'));
    }
    public function submit(Request $request, $id)
    {
        abort_unless(Gate::allows('pengajuan_access') and Gate::allows('is_irban'), 403);
        $pengajuan = Pengajuan::find($id);
        if ($request->status_pengajuan == "terima") {
            $pengajuan->update([
                'status_pengajuan'    => 'disetujui_irban',
            ]);
        } else if ($request->status_pengajuan == "tolak") {
            $pengajuan->update([
                'status_pengajuan'    => 'ditolak_irban',
                'keterangan_pengajuan'    => $request->keterangan_pengajuan,
            ]);
        } else {
            return back();
        }
        return back();
    }
    public function show($id)
    {
        abort_unless(Gate::allows('pengajuan_show') and Gate::allows('is_irban'), 403);
        $paraf = User::whereIn('id',[2,32,33])->get();
        $pengajuan = Pengajuan::find($id);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $pengajuan->load('dasar');
        $pengajuan->load('anggota');
        return view('dashboard.irban.pengajuans.show', compact('pengajuan', 'jml_hari','paraf'));
    }
    public function showprogramkegiatan($id)
    {
        abort_unless(Gate::allows('pengajuan_show') and Gate::allows('is_irban'), 403);
        $pengajuan = Pengajuan::find($id);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $pengajuan->load('dasar');
        $pengajuan->load('anggota');
        return view('dashboard.irban.programkegiatans.show', compact('pengajuan', 'jml_hari'));
    }

    public function cetak_notadinas($id)
    {
        abort_unless(Gate::allows('pengajuan_show'), 403);
        return Pengajuan::cetak_notadinas($id);
    }
    public function download_lhp($id)
    {
        abort_unless(Gate::allows('is_irban'), 403);
        $pengajuan = Pengajuan::find($id);
        $file = public_path()."/berkas_lhp/$id/$pengajuan->berkas";
    	$headers = ['Content-Type: application/pdf'];
        
    	return response()->download($file, $pengajuan->berkas, $headers);
    }
    public function cetak_spt($id,Request $request)
    {
        abort_unless(Gate::allows('is_irban'), 403);
        return Pengajuan::cetak_spt($id,$request->paraf);
    }
    private function selectPengajuan($status)
    {
        if (is_array($status)) {
            $data_pengajuan = Pengajuan::where('supervisor', $this->user_id)
                ->whereIn('status_pengajuan', $status)
                ->get();
        } else {
            $data_pengajuan = Pengajuan::where('supervisor', $this->user_id)
                ->where('status_pengajuan', $status)
                ->get();
        }
        return $data_pengajuan;
    }
    private function selectSpt($level, $uid)
    {
        $data_spts = Pengajuan::where($level, $uid)
            ->where('no_spt', '!=', null)
            ->where('status_pengajuan', 'disetujui_inspektur')
            ->select('id','supervisor', 'wilayah', 'objek', 'no_spt', 'tgl_terbit', 'nama_kegiatan', 'no_lhp')->get();
        return $data_spts;
    }
}

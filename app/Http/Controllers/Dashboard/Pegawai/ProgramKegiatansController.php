<?php

namespace App\Http\Controllers\Dashboard\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class ProgramKegiatansController extends Controller
{
    protected $user_id, $wilayah_id, $role_id;

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
        $programkegiatans = Pengajuan::where([
            ['wilayah', '=', $this->wilayah_id],
            ['no_spt', '!=', null],
            ['no_lhp', '=', null],
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
        return view('dashboard.pegawai.programkegiatans.index', compact('programkegiatans','user_id'));
    }
    public function riwayat()
    {
        abort_unless(Gate::allows('is_pegawai'), 403);
        $user_id = $this->user_id;
        $programkegiatans = Pengajuan::where([
            ['wilayah', '=', $this->wilayah_id],
            ['no_spt', '!=', null],
            ['no_lhp', '!=', null],
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
        return view('dashboard.pegawai.programkegiatans.riwayat', compact('programkegiatans','user_id'));
    }
    public function upload_lhp($id)
    {
        abort_unless(Gate::allows('programkegiatan_create'), 403);
        $pengajuan = Pengajuan::find($id);
        $wilayah_id = Auth::user()->roles[0]->wilayah->id;
        $isYourData = ($pengajuan->wilayah == $wilayah_id);
        abort_unless($isYourData, 403);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        return view('dashboard.pegawai.programkegiatans.upload_lhp', compact('pengajuan','jml_hari'));
    }
    public function store_lhp(Request $request, $id)
    {
        abort_unless(Gate::allows('programkegiatan_create'), 403);
        $berkas = $request->file('berkas');
		$file_name = time()."_".$berkas->getClientOriginalName();
        $pengajuan = Pengajuan::find($id);
        $pengajuan->update([
            'no_lhp' => $request->no_lhp,
            'berkas' => $file_name,
            'tgl_submit' =>  Carbon::createFromFormat('d/m/Y',$request->tgl_submit)->format('Y-m-d'),
        ]);
		$upload_to = "/berkas_lhp/$pengajuan->id";
        $berkas->move(public_path().$upload_to,$file_name);

        return redirect(route('dashboard.pegawai.riwayatkegiatans.index'));
    }
    public function show($id)
    {
        abort_unless(Gate::allows('pengajuan_show'), 403);
        $pengajuan = Pengajuan::find($id);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $pengajuan->load('dasar');
        $pengajuan->load('anggota');
        return view('dashboard.pegawai.programkegiatans.show', compact('pengajuan','jml_hari'));
    }
    public function download_lhp($id)
    {
        abort_unless(Gate::allows('programkegiatan_create'), 403);
        $pengajuan = Pengajuan::find($id);
        $file = public_path()."/berkas_lhp/$id/$pengajuan->berkas";
    	$headers = ['Content-Type: application/pdf'];
        
    	return response()->download($file, $pengajuan->berkas, $headers);
    }
}

<?php

namespace App\Http\Controllers\Dashboard\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\Http\Requests\Pengajuan\PengajuanStoreReq;
use App\Http\Requests\Pengajuan\PengajuanUpdateReq;
use App\Models\UserManagement\User;
use App\Models\Anggotapengajuan;
use App\Models\Pengajuan;
use App\Models\Tujuanpengajuan;
use Illuminate\Support\Facades\Auth;

class PengajuansController extends Controller
{
    protected $user_id, $wilayah_id, $role_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = $request->user()->id;
            $this->wilayah_id = $request->user()->roles[0]->wilayah_id;
            $this->role_id = $request->user()->roles[0]->id;
            return $next($request);
        });
    }
    public function index()
    {
        abort_unless(Gate::allows('is_pegawai'), 403);
        $belum_disubmit = $this->selectPengajuan('disimpan');
        $disubmit = $this->selectPengajuan(['disubmit','disetujui_irban']);
        $diterima = $this->selectPengajuan('disetujui_inspektur');
        $ditolak = $this->selectPengajuan(['ditolak_irban', 'ditolak_inspektur']);
        $user_id = $this->user_id;
        return view('dashboard.pegawai.pengajuans.index', compact('belum_disubmit', 'disubmit', 'diterima', 'ditolak', 'user_id'));
    }
    public function create()
    {
        abort_unless(Gate::allows('pengajuan_create'), 403);
        $inspektur = User::with('kepegawaian')
            ->whereRelation('roles', 'tipe', '=', 'inspektur')
            ->first();
        $irban = User::whereRelation('roles', 'wilayah_id', '=', $this->wilayah_id)
            ->whereRelation('roles', 'tipe', '=', 'irban')
            ->first();
        $pengendali_teknis = User::whereRelation('roles', 'wilayah_id', '=', $this->wilayah_id)
            ->whereRelation('roles', 'tipe', '=', 'pegawai')->get();
        $anggota = User::whereRelation('roles', 'wilayah_id', '=', $this->wilayah_id)
            ->whereRelation('roles', 'tipe', '=', 'pegawai')->get();
        return view('dashboard.pegawai.pengajuans.create', compact('inspektur', 'irban', 'pengendali_teknis', 'anggota'));
    }

    public function store(PengajuanStoreReq $request)
    {
        abort_unless(Gate::allows('pengajuan_create'), 403);
        $rencana_kegiatan = explode(" - ", $request->rencana_kegiatan);
        $tgl_berangkat = Carbon::createFromFormat('d/m/Y',$rencana_kegiatan[0])->format('Y-m-d');
        $tgl_kembali = Carbon::createFromFormat('d/m/Y',$rencana_kegiatan[1])->format('Y-m-d');
        $anggota_id = array();
        $tujuan_id = array();
        $pengajuan = Pengajuan::create([
            'nama_kegiatan'       => $request->nama_kegiatan,
            'jenis'               => $request->jenis,
            'penanggung_jawab'    => $request->penanggung_jawab,
            'supervisor'          => $request->supervisor,
            'pengendali_teknis'   => $request->pengendali_teknis,
            'ketua_tim'           => $request->ketua_tim,
            'wilayah'             => $request->wilayah,
            'objek'               => $request->objek,
            'ruang_lingkup'       => $request->ruang_lingkup,
            'tgl_pengajuan'       => Carbon::now(),
            'tgl_berangkat'       => $tgl_berangkat,
            'tgl_kembali'         => $tgl_kembali,
            'uraian'              => $request->uraian,
            'status_pengajuan'    => 'disimpan',
        ]);
        for ($i = 0; $i < sizeof($request->anggota); $i++) {
            $anggota = Anggotapengajuan::create([
                'user_id'  => $request->anggota[$i],
            ]);
            array_push($anggota_id, $anggota->id);
        }
        for ($i = 0; $i < sizeof($request->tujuan); $i++) {
            $tujuan = Tujuanpengajuan::create([
                'tujuan'  => $request->tujuan[$i],
            ]);
            array_push($tujuan_id, $tujuan->id);
        }
        for ($i = 0; $i < sizeof($anggota_id); $i++) {
            $pengajuan->anggota()->sync($anggota_id[$i], []);
        }
        for ($i = 0; $i < sizeof($tujuan_id); $i++) {
            $pengajuan->tujuan()->sync($tujuan_id[$i], []);
        }
        return redirect()->route('dashboard.pegawai.pengajuans.index');
    }

    public function edit(Pengajuan $pengajuan)
    {
        abort_unless(Gate::allows('pengajuan_edit'), 403);
        abort_unless(Gate::allows('pengajuan_create'), 403);
        $inspektur = User::with('kepegawaian')
            ->whereRelation('roles', 'tipe', '=', 'inspektur')
            ->first();
        $irban = User::whereRelation('roles', 'wilayah_id', '=', $this->wilayah_id)
            ->whereRelation('roles', 'tipe', '=', 'irban')
            ->first();
        $pengendali_teknis = User::whereRelation('roles', 'wilayah_id', '=', $this->wilayah_id)
            ->whereRelation('roles', 'tipe', '=', 'pegawai')->get();
        $anggota = User::whereRelation('roles', 'wilayah_id', '=', $this->wilayah_id)
            ->whereRelation('roles', 'tipe', '=', 'pegawai')->get();
        $tgl_berangkat = Carbon::parse($pengajuan->tgl_berangkat)->format("m/d/Y h:m A");
        $tgl_kembali = Carbon::parse($pengajuan->tgl_kembali)->format("m/d/Y h:m A");
        return view('dashboard.pegawai.pengajuans.edit', compact('pengajuan', 'inspektur', 'irban', 'pengendali_teknis', 'anggota', 'tgl_berangkat', 'tgl_kembali'));
    }

    public function update(PengajuanUpdateReq $request, Pengajuan $pengajuan)
    {
        abort_unless(Gate::allows('pengajuan_edit'), 403);
        $tujuan_id = array();
        $anggota_id = array();
        $rencana_kegiatan = explode(" - ", $request->rencana_kegiatan);
        $tgl_berangkat = Carbon::createFromFormat('d/m/Y',$rencana_kegiatan[0])->format('Y-m-d');
        $tgl_kembali = Carbon::createFromFormat('d/m/Y',$rencana_kegiatan[1])->format('Y-m-d');
        $pengajuan->update([
            'nama_kegiatan'       => $request->nama_kegiatan,
            'jenis'               => $request->jenis,
            'penanggung_jawab'    => $request->penanggung_jawab,
            'supervisor'          => $request->supervisor,
            'pengendali_teknis'   => $request->pengendali_teknis,
            'ketua_tim'           => $request->ketua_tim,
            'wilayah'             => $request->wilayah,
            'objek'               => $request->objek,
            'ruang_lingkup'       => $request->ruang_lingkup,
            'tgl_pengajuan'       => Carbon::now(),
            'tgl_berangkat'       => $tgl_berangkat,
            'tgl_kembali'         => $tgl_kembali,
            'uraian'              => $request->uraian,
        ]);
        //Delete Anggota
        foreach ($pengajuan->anggota as $anggota) {
            array_push($anggota_id, $anggota->id);
        }
        Anggotapengajuan::whereIn('id', $anggota_id)->delete();
        //Reinsert Anggota
        $anggota_id = array();
        for ($i = 0; $i < sizeof($request->anggota); $i++) {
            $anggota = Anggotapengajuan::create([
                'user_id'  => $request->anggota[$i],
            ]);
            array_push($anggota_id, $anggota->id);
        }
        for ($i = 0; $i < sizeof($anggota_id); $i++) {
            $pengajuan->anggota()->sync($anggota_id[$i], []);
        }
        //Delete Tujuan
        foreach ($pengajuan->tujuan as $tujuan) {
            array_push($tujuan_id, $tujuan->id);
        }
        Tujuanpengajuan::whereIn('id', $tujuan_id)->delete();
        //Reinsert Tujuan
        $tujuan_id = array();
        for ($i = 0; $i < sizeof($request->tujuan); $i++) {
            $tujuan = Tujuanpengajuan::create([
                'tujuan'  => $request->tujuan[$i],
            ]);
            array_push($tujuan_id, $tujuan->id);
        }
        for ($i = 0; $i < sizeof($tujuan_id); $i++) {
            $pengajuan->tujuan()->sync($tujuan_id[$i], []);
        }
        return redirect()->route('dashboard.pegawai.pengajuans.index');
    }

    public function submit($id)
    {
        abort_unless(Gate::allows('pengajuan_edit'), 403);
        $pengajuan = Pengajuan::find($id);
        $pengajuan->update([
            'status_pengajuan'    => 'disubmit',
        ]);
        return back();
    }

    public function show(Pengajuan $pengajuan)
    {
        abort_unless(Gate::allows('pengajuan_show'), 403);
        $wilayah_id = Auth::user()->roles[0]->wilayah->id;
        $isYourData = ($pengajuan->wilayah == $wilayah_id);
        abort_unless($isYourData or Gate::allows('is_inspektur'), 403);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $pengajuan->load('dasar');
        $pengajuan->load('anggota');
        return view('dashboard.pegawai.pengajuans.show', compact('pengajuan', 'jml_hari'));
    }

    public function cetak_notadinas($id)
    {
        abort_unless(Gate::allows('pengajuan_show'), 403);
        return Pengajuan::cetak_notadinas($id);
    }

    public function destroy(Pengajuan $pengajuan)
    {
        abort_unless(Gate::allows('pengajuan_delete'), 403);
        $anggota_id = array();
        $tujuan_id = array();
        foreach ($pengajuan->anggota as $anggota) {
            array_push($anggota_id, $anggota->id);
        }
        foreach ($pengajuan->tujuan as $tujuan) {
            array_push($tujuan_id, $tujuan->id);
        }
        Anggotapengajuan::whereIn('id', $anggota_id)->delete();
        Tujuanpengajuan::whereIn('id', $tujuan_id)->delete();
        $pengajuan->delete();
        return back();
    }

    public function massDestroy()
    {
        Pengajuan::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }

    private function selectPengajuan($status)
    {
        if (is_array($status)) {
            $data_pengajuan = Pengajuan::where('wilayah', '=', $this->wilayah_id)
                ->whereIn('status_pengajuan', $status)
                ->where(function ($query) {
                    $query->where('penanggung_jawab', $this->user_id)
                        ->orWhere('supervisor', $this->user_id)
                        ->orWhere('ketua_tim', $this->user_id)
                        ->orWhere(function ($another_query) {
                            $another_query->whereHas('anggota', function ($q) {
                                $q->where('user_id', $this->user_id);
                            });
                        });
                })
                ->get();
        } else {
            $data_pengajuan = Pengajuan::where([
                ['wilayah', '=', $this->wilayah_id],
                ['status_pengajuan', $status],
            ])->where(function ($query) {
                $query->where('penanggung_jawab', $this->user_id)
                    ->orWhere('supervisor', $this->user_id)
                    ->orWhere('ketua_tim', $this->user_id)
                    ->orWhere(function ($another_query) {
                        $another_query->whereHas('anggota', function ($q) {
                            $q->where('user_id', $this->user_id);
                        });
                    });
            })
                ->get();
        }
        return $data_pengajuan;
    }
}

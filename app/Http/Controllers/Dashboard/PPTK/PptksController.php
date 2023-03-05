<?php

namespace App\Http\Controllers\Dashboard\PPTK;

use App\Http\Controllers\Controller;
use App\Http\Requests\Spt\SptStoreReq;
use App\Models\Dasarpengajuan;
use Illuminate\Support\Facades\Gate;
use App\Models\Pengajuan;
use App\Models\Tembusanpengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
class PptksController extends Controller
{

    public function spt_terbit()
    {
        abort_unless(Gate::allows('is_pptk'), 403);
        $sptswil1 = $this->selectSpt(1,'terbit');
        $sptswil2 = $this->selectSpt(2,'terbit');
        $sptswil3 = $this->selectSpt(3,'terbit');
        $sptswil4 = $this->selectSpt(4,'terbit');
        return view('dashboard.pptk.spts.index', compact('sptswil1', 'sptswil2', 'sptswil3', 'sptswil4'));
    }

    public function spt_tertunda()
    {
        abort_unless(Gate::allows('is_pptk'), 403);
        $sptswil1 = $this->selectSpt(1,'tertunda');
        $sptswil2 = $this->selectSpt(2,'tertunda');
        $sptswil3 = $this->selectSpt(3,'tertunda');
        $sptswil4 = $this->selectSpt(4,'tertunda');
        return view('dashboard.pptk.spts.index', compact('sptswil1', 'sptswil2', 'sptswil3', 'sptswil4'));
    }

    public function create($id)
    {
        abort_unless(Gate::allows('spt_create'), 403);
        $pengajuan = Pengajuan::find($id);
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $tahun = Carbon::now()->format('Y');
        return view('dashboard.pptk.spts.create', compact('pengajuan', 'jml_hari', 'tahun'));
    }
    public function store(SptStoreReq $request, $id)
    {
        abort_unless(Gate::allows('spt_create'), 403);
        $pengajuan = Pengajuan::find($id);
        $tahun = Carbon::now()->format('Y');
        $dasar_id = array();
        $tembusan_id = array();
        $pengajuan->update([
            'no_spt' => Pengajuan::setNomorSpt($request->no_spt,$tahun),
            'tgl_terbit' => Carbon::createFromFormat('d/m/Y',$request->tgl_terbit)->format('Y-m-d'),
        ]);
        for ($i = 0; $i < sizeof($request->dasar); $i++) {
            if($request->dasar[$i] !=null){
                $dasar = Dasarpengajuan::create([
                    'dasar'  => $request->dasar[$i],
                ]);
            }
            array_push($dasar_id, $dasar->id);
        }
        for ($i = 0; $i < sizeof($dasar_id); $i++) {
            $pengajuan->dasar()->sync($dasar_id[$i], []);
        }
        for ($i = 0; $i < sizeof($request->tembusan); $i++) {
            if($request->tembusan[$i] !=null){
                $tembusan = Tembusanpengajuan::create([
                    'tembusan'  => $request->tembusan[$i],
                ]);
            }
            array_push($tembusan_id, $tembusan->id);
        }
        for ($i = 0; $i < sizeof($tembusan_id); $i++) {
            $pengajuan->tembusan()->sync($tembusan_id[$i], []);
        }
        return redirect()->route('dashboard.pptk.spts.spt_terbit');
    }

    public function cetak_spt($id, Request $request)
    {
        abort_unless(Gate::allows('spt_access') || Gate::allows('pengajuan_create'), 403);
        return Pengajuan::cetak_spt($id,$request->paraf);
    }
    private function selectSpt($wilayah,$status)
    {
        if($status == 'terbit'){
            $opt = '!=';
        }else{
            $opt = '=';
        }
        return Pengajuan::where([
            ['wilayah', $wilayah],
            ['status_pengajuan', 'disetujui_inspektur'],
            ['no_spt', $opt, null],
        ])
            ->select('id', 'objek', 'no_spt', 'tgl_terbit', 'nama_kegiatan', 'no_lhp')
            ->get();
    }
}

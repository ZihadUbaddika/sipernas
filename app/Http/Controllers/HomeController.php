<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\UserManagement\Kepegawaian;
use App\Models\UserManagement\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user_id, $wilayah_id;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user_id = $request->user()->id;
            $this->wilayah_id = $request->user()->roles[0]->wilayah_id;
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Gate::check('user_management_access')) {
            //Dashboard admin
            $admin_dashboard = [];
            $admin_count_pegawai = Kepegawaian::count();
            $admin_dashboard['count_pegawai'] = $admin_count_pegawai;
            return view('dashboard.admin.home', compact('admin_dashboard'));
        }else if (Gate::check('is_inspektur')) {
            //Dashboard Inspektur
            $inspektur_dashboard = [];
            $inspektur_count_pengajuanbelumacc = Pengajuan::where([
                ['status_pengajuan', '=', 'disetujui_irban'],
                ['no_spt', '=', null]
                ])->count();
            $inspektur_count_programkegiatan = Pengajuan::where([
                ['status_pengajuan', '=', 'disetujui_inspektur'],
                ['no_spt', '!=', null],
                ['no_lhp', '=', null],
                ])->count();
            $inspektur_dashboard['count_pengajuanbelumacc'] = $inspektur_count_pengajuanbelumacc;
            $inspektur_dashboard['count_programkegiatan'] = $inspektur_count_programkegiatan;
            return view('dashboard.inspektur.home', compact('inspektur_dashboard'));
        }else if (Gate::check('is_pptk')) {
            //Dashboard PPTK
            $pptk_dashboard = [];
            $pegawai_count_sptterbit = Pengajuan::where([
                ['status_pengajuan', '=', 'disetujui_inspektur'],
                ['no_spt', '!=', null]
                ])->count();
            $pegawai_count_spttertunda = Pengajuan::where([
                ['status_pengajuan', '=', 'disetujui_inspektur'],
                ['no_spt', '=', null]
            ])->count();
            $pptk_dashboard['count_sptterbit'] = $pegawai_count_sptterbit;
            $pptk_dashboard['count_spttertunda'] = $pegawai_count_spttertunda;
            return view('dashboard.pptk.home', compact('pptk_dashboard'));
        }else if (Gate::check('is_irban')) {
            //Dashboard Irban
            $irban_dashboard = [];
            $irban_count_pengajuanbelumacc = Pengajuan::where([
                ['status_pengajuan', '=', 'disubmit'],
                ['no_spt', '=', null],
                ['wilayah', '=', $this->wilayah_id]
                ])->count();
            $irban_count_programkegiatan = Pengajuan::where([
                ['status_pengajuan', '=', 'disetujui_inspektur'],
                ['no_spt', '!=', null],
                ['no_lhp', '=', null],
                ['wilayah', '=', $this->wilayah_id]
                ])->count();
            $irban_dashboard['count_pengajuanbelumacc'] = $irban_count_pengajuanbelumacc;
            $irban_dashboard['count_programkegiatan'] = $irban_count_programkegiatan;
            return view('dashboard.irban.home', compact('irban_dashboard'));
        }else{
            //Dashboard Pegawai
            $pegawai_dashboard = [];
            $pegawai_count_pengajuan = Pengajuan::where([
                ['wilayah', '=', $this->wilayah_id],
            ])->where(function ($query) {
                $query->where('penanggung_jawab', $this->user_id)
                    ->orWhere('supervisor', $this->user_id)
                    ->orWhere('ketua_tim', $this->user_id)
                    ->orWhere(function ($another_query) {
                        $another_query->whereHas('anggota', function ($q) {
                            $q->where('user_id', $this->user_id);
                        });
                    });
            })->count();
            $pegawai_count_programkegiatan = Pengajuan::where([
                ['wilayah', '=', $this->wilayah_id],
                ['status_pengajuan', '=', 'disetujui_inspektur'],
                ['no_spt', '!=', null],
                ['no_lhp', '=', null]
            ])->where(function ($query) {
                $query->where('penanggung_jawab', $this->user_id)
                    ->orWhere('supervisor', $this->user_id)
                    ->orWhere('ketua_tim', $this->user_id)
                    ->orWhere(function ($another_query) {
                        $another_query->whereHas('anggota', function ($q) {
                            $q->where('user_id', $this->user_id);
                        });
                    });
            })->count();
            $pegawai_count_spt = Pengajuan::where([
                ['wilayah', '=', $this->wilayah_id],
                ['status_pengajuan', '=', 'disetujui_inspektur'],
                ['no_spt', '!=', null],
            ])->where(function ($query) {
                $query->where('penanggung_jawab', $this->user_id)
                    ->orWhere('supervisor', $this->user_id)
                    ->orWhere('ketua_tim', $this->user_id)
                    ->orWhere(function ($another_query) {
                        $another_query->whereHas('anggota', function ($q) {
                            $q->where('user_id', $this->user_id);
                        });
                    });
            })->count();
            $pegawai_count_riwayat = Pengajuan::where([
                ['wilayah', '=', $this->wilayah_id],
                ['status_pengajuan', '=', 'disetujui_inspektur'],
                ['no_spt', '!=', null],
                ['no_lhp', '!=', null],
            ])->where(function ($query) {
                $query->where('penanggung_jawab', $this->user_id)
                    ->orWhere('supervisor', $this->user_id)
                    ->orWhere('ketua_tim', $this->user_id)
                    ->orWhere(function ($another_query) {
                        $another_query->whereHas('anggota', function ($q) {
                            $q->where('user_id', $this->user_id);
                        });
                    });
            })->count();
            $pegawai_dashboard['count_pengajuan'] = $pegawai_count_pengajuan;
            $pegawai_dashboard['count_programkegiatan'] = $pegawai_count_programkegiatan;
            $pegawai_dashboard['count_spt'] = $pegawai_count_spt;
            $pegawai_dashboard['count_riwayat'] = $pegawai_count_riwayat;
            return view('dashboard.pegawai.home', compact('pegawai_dashboard'));
        }
    }
    public function profile_saya($id){
        if (Gate::check('user_management_access') || Gate::check('is_inspektur') || Gate::check('is_pptk') || Gate::check('is_irban') || Gate::check('is_pegawai')) {
            $kepegawaian = Kepegawaian::find($id);
            return view('dashboard.profile',compact('kepegawaian'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserManagement\User;

class HomepageController extends Controller
{
    public function index(){
        $inspektur = User::with('kepegawaian')->whereRelation('roles', 'tipe', '=', 'inspektur')->first();
        $sekretaris = User::with('kepegawaian')->whereRelation('roles', 'tipe', '=', 'sekretaris')->first();
        $umum = User::with('kepegawaian')->whereRelation('roles', 'tipe', '=', 'subbag_umum')->first();
        $analisis = User::with('kepegawaian')->whereRelation('roles', 'tipe', '=', 'subbag_analisis')->first();
        $perencanaan = User::with('kepegawaian')->whereRelation('roles', 'tipe', '=', 'subbag_perencanaan')->first();
        $irban1 = User::with('kepegawaian')->whereRelation('roles', 'title', '=', 'Irban Wilayah 1')->first();
        $irban2 = User::with('kepegawaian')->whereRelation('roles', 'title', '=', 'Irban Wilayah 2')->first();
        $irban3 = User::with('kepegawaian')->whereRelation('roles', 'title', '=', 'Irban Wilayah 3')->first();
        $irban4 = User::with('kepegawaian')->whereRelation('roles', 'title', '=', 'Irban Wilayah 4')->first();

        return view('landing.struktur', compact('inspektur','sekretaris','umum','analisis','perencanaan', 'irban1','irban2','irban3','irban4'));
    }
}

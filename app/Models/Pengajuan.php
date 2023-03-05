<?php

namespace App\Models;

use App\Models\UserManagement\Kepegawaian;
use App\Models\UserManagement\User;
use App\Models\UserManagement\Wilayah;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use phpDocumentor\Reflection\Types\Void_;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Style\Border;

class Pengajuan extends Model
{
    use HasFactory;

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'tgl_pengajuan',
        'tgl_berangkat',
        'tgl_kembali',
    ];
    protected $hidden = ['pivot'];
    protected $fillable = [
        'nama_kegiatan',
        'jenis',
        'penanggung_jawab',
        'supervisor',
        'pengendali_teknis',
        'ketua_tim',
        'wilayah',
        'objek',
        'ruang_lingkup',
        'tgl_pengajuan',
        'tgl_berangkat',
        'tgl_kembali',
        'uraian',
        'status_pengajuan',
        'keterangan_pengajuan',
        'no_spt',
        'tgl_terbit',
        'no_lhp',
        'berkas',
        'tgl_submit',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public const status_select = [
        'disimpan'             => 'Belum disubmit',
        'disubmit'             => 'Disubmit',
        'disetujui_irban'      => 'Disetujui Irban',
        'ditolak_irban'        => 'Ditolak Irban',
        'disetujui_inspektur'  => 'Disetujui Inspektur',
        'ditolak_inspektur'    => 'Ditolak Inspektur',
    ];
    public const jenislhp_select = [
        'reguler'              => 'Reguler',
        'berkala'              => 'Berkala',
        'monev'                => 'Monitoring & Evaluasi',
        'reviu'                => 'Reviu',
    ];
    public const cetakspt_select = [
        'gubernur'          => 'Gubernur Lampung',
        'wakil_gubernur'    => 'Wakil Gubernur Lampung',
        'inspektur'         => 'Inspektur',
    ];
    public const wilayah_select = [
        'semua'                => 'Semua',
        '1'                    => 'Wilayah 1',
        '2'                    => 'Wilayah 2',
        '3'                    => 'Wilayah 3',
        '4'                    => 'Wilayah 4',
    ];
    
    public const dasar_select = [
        '1'                    => 'Undang – undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah sebagaimana telah diubah dengan Undang-Undang Nomor 9 Tahun 2015.',
        '2'                    => 'Peraturan Pemerintah Nomor 12 Tahun 2017 tentang Pedoman Pembinaan & Pengawasan atas Penyelenggaraan Pemerintahan Daerah.',
        '3'                    => 'Peraturan Menteri Dalam Negeri Nomor 48 Tahun 2021 tentang Perencanaan Pembinaan dan Pengawasan Penyelenggaraan Pemerintahan Daerah Tahun 2022.',
        '4'                    => 'Peraturan Daerah Gubernur Lampung Nomor 56 Tahun 2019 tentang Kedudukan, Susuna Organisasi, Tugas dan Fungsi serta Tatakerja Perangkat Daerah Provinsi Lampung.',
        '5'                    => 'Keputusan Gubernur Lampung Nomor : G/155/IV.01/HK/2022 tentang Program Kerja Pengawasan Tahunan Berbasis Resiko Inspektorat Provinsi Lampung pada Organisasi Perangkat Daerah di Lingkungan Pemerintah Provinsi Lampung dan Pemerintahan Kabupaten/Kota Se-Provinsi Lampung Tahun 2022.',
        '6'                    => 'Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah sebagaimana telah diubah dengan Undang-Undang Nomor 9 Tahun 2015',
    ];
    public function dasar()
    {
        return $this->belongsToMany(Dasarpengajuan::class);
    }
    public function tembusan()
    {
        return $this->belongsToMany(Tembusanpengajuan::class);
    }
    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab', 'id');
    }
    public function superVisor()
    {
        return $this->belongsTo(User::class, 'supervisor', 'id');
    }
    public function pengendaliTeknis()
    {
        return $this->belongsTo(User::class, 'pengendali_teknis', 'id');
    }
    public function ketuaTim()
    {
        return $this->belongsTo(User::class, 'ketua_tim', 'id');
    }
    public function anggota()
    {
        return $this->belongsToMany(Anggotapengajuan::class);
    }
    public function dataWilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah', 'id');
    }
    public function tujuan()
    {
        return $this->belongsToMany(Tujuanpengajuan::class);
    }
    public function getTglPengajuanAtribute()
    {
        return Carbon::parse($this->attributes['tgl_pengajuan'])->translatedFormat('d F Y');
    }
    public function getTglBerangkatAtribute()
    {
        return Carbon::parse($this->attributes['tgl_berangkat'])->translatedFormat('l, d F Y');
    }
    public function getTglBerangkatAtributeNotaDinas()
    {
        return Carbon::parse($this->attributes['tgl_berangkat'])->translatedFormat('d F Y');
    }
    public function tahunNotaDinas()
    {
        return Carbon::parse($this->attributes['tgl_berangkat'])->translatedFormat('Y');
    }
    public function getTglKembaliAtribute()
    {
        return Carbon::parse($this->attributes['tgl_kembali'])->translatedFormat('l, d F Y');
    }
    public function getTglTerbitAtribute()
    {
        return Carbon::parse($this->attributes['tgl_terbit'])->translatedFormat('d F Y');
    }
    public static function getWilayahId()
    {
        return Auth::user()->roles[0]->wilayah->id;
    }
    public static function tglFormatter($val, $format)
    {
        return Carbon::parse($val)->translatedFormat($format);
    }
    public static function setNomorSpt($nomor){
        $no_spt = "$nomor";
        return $no_spt;
    }
    public static function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = Pengajuan::penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = Pengajuan::penyebut($nilai / 10) . " puluh" . Pengajuan::penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . Pengajuan::penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = Pengajuan::penyebut($nilai / 100) . " ratus" . Pengajuan::penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . Pengajuan::penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = Pengajuan::penyebut($nilai / 1000) . " ribu" . Pengajuan::penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = Pengajuan::penyebut($nilai / 1000000) . " juta" . Pengajuan::penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = Pengajuan::penyebut($nilai / 1000000000) . " milyar" . Pengajuan::penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = Pengajuan::penyebut($nilai / 1000000000000) . " trilyun" . Pengajuan::penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
    public static function cetak_notadinas($id)
    {
        abort_unless(Gate::allows('pengajuan_show'), 403);
        $pengajuan = Pengajuan::find($id);
        $tgl_notadinas = $pengajuan->getTglPengajuanAtribute();
        $tgl = $pengajuan->getTglBerangkatAtribute();
        switch ($pengajuan->wilayah) {
            case '1':
                $wilayah_id = 'I';
                break;
            case '2':
                $wilayah_id = 'II';
                break;
            case '3':
                $wilayah_id = 'III';
                break;
            case '4':
                $wilayah_id = 'IV';
                break;
        }
        $irban_nama = $pengajuan->superVisor->kepegawaian->nama;
        $irban_pangkat = $pengajuan->superVisor->kepegawaian->pangkat;
        $irban_nip = $pengajuan->superVisor->kepegawaian->nip;
        $tahun_notadinas = $pengajuan->tahunNotaDinas();
        $jml_hari = $pengajuan->tgl_berangkat->diffInDays($pengajuan->tgl_kembali);
        $hari = Pengajuan::penyebut($jml_hari);
        $rencana_pelaksanaan = "Waktu pelaksanaan direncanakan selama " . $jml_hari . ' (' . $hari . ' )' . ' hari kerja dari hari ' . $pengajuan->getTglBerangkatAtribute() . '  sampai dengan ' . $pengajuan->getTglKembaliAtribute() . '.';
        $index = 1;
        $templateProcessor = new TemplateProcessor('assets/template/nota_dinas.docx');
        $anggotaTable = new Table();
        foreach ($pengajuan->anggota as $anggota) {
            $anggotaTable->addRow();
            $anggotaTable->addCell()->addText($index . '. ');
            $anggotaTable->addCell()->addText($anggota->user->kepegawaian->nama);
            $index++;
        }
        $index = 1;
        $tujuanTable = new Table();
        foreach ($pengajuan->tujuan as $tujuan) {
            $tujuanTable->addRow();
            $tujuanTable->addCell()->addText($index . '. ');
            $tujuanTable->addCell()->addText($tujuan->tujuan);
            $index++;
        }
        $templateProcessor->setComplexBlock('anggota', $anggotaTable);
        $templateProcessor->setComplexBlock('tujuan', $tujuanTable);
        $templateProcessor->setValues([
            'wilayah_id' => $wilayah_id,
            'irban_nama' => $irban_nama,
            'irban_pangkat' => $irban_pangkat,
            'irban_nip' => $irban_nip,
            'tahun_notadinas' => $tahun_notadinas,
            'tgl' => $tgl,
            'tgl_notadinas' => $tgl_notadinas,
            'nama_kegiatan' => $pengajuan->nama_kegiatan,
            'uraian' => $pengajuan->uraian,
            'penanggung_jawab' => $pengajuan->penanggungJawab->kepegawaian->nama,
            'supervisor' => $pengajuan->superVisor->kepegawaian->nama,
            'pengendali_teknis' => $pengajuan->pengendaliTeknis->kepegawaian->nama,
            'ketua_tim' => $pengajuan->ketuaTim->kepegawaian->nama,
            'objek' => $pengajuan->objek,
            'ruang_lingkup' => $pengajuan->ruang_lingkup,
            'rencana_pelaksanaan' => $rencana_pelaksanaan,
        ]);
        $hash = $pengajuan->id . Carbon::now();
        $filename = "NotaDinas_" . hash('sha1', $hash);
        header("Content-Disposition: attachment; filename=" . $filename . ".docx");
        return $templateProcessor->saveAs('php://output');
    }
    public static function cetak_spt($id, $paraf)
    {
        $pengajuan = Pengajuan::find($id);
        $templateProcessor = new TemplateProcessor('assets/template/spt.docx');
        $anggotaTable = new Table(array('borderSize' => 6));
        $index = 4;
        for ($i = 0; $i < $pengajuan->anggota->count() + 3; $i++) {
            if ($i == 0) {
                $anggotaTable->addRow();
                $anggotaTable->addCell(1300)->addText('Kepada');
                $anggotaTable->addCell()->addText($i+1 . '. ');
                $anggotaTable->addCell(8000)->addText($pengajuan->superVisor->kepegawaian->nama);
                $anggotaTable->addCell(5000)->addText("Supervisor");
                continue;
            }
            if ($i == 1) {
                $anggotaTable->addRow();
                $anggotaTable->addCell(1300)->addText('');
                $anggotaTable->addCell()->addText($i+1 . '. ');
                $anggotaTable->addCell(8000)->addText($pengajuan->pengendaliTeknis->kepegawaian->nama);
                $anggotaTable->addCell(5000)->addText("Pengendali Teknis");
                continue;
            }
            if ($i == 2) {
                $anggotaTable->addRow();
                $anggotaTable->addCell(1300)->addText('');
                $anggotaTable->addCell()->addText($i+1 . '. ');
                $anggotaTable->addCell(8000)->addText($pengajuan->ketuaTim->kepegawaian->nama);
                $anggotaTable->addCell(5000)->addText("Ketua Tim");
                continue;
            }
            $anggotaTable->addRow();
            $anggotaTable->addCell(1300)->addText('');
            $anggotaTable->addCell()->addText($i+1 . '. ');
            $anggotaTable->addCell(8000)->addText($pengajuan->anggota[($i-3)]->user->kepegawaian->nama);
            $anggotaTable->addCell(5000)->addText("Anggota");
            $index++;
        }
        $dasarTable = new Table();
        $index = 1;
        foreach ($pengajuan->dasar as $dasar) {
            $dasarTable->addRow();
            $dasarTable->addCell()->addText($index . '. ');
            $dasarTable->addCell()->addText($dasar->dasar);
            $index++;
        }
        $tembusanTable = new Table();
        $index = 1;
        foreach ($pengajuan->tembusan as $tembusan) {
            $tembusanTable->addRow();
            $tembusanTable->addCell()->addText($index . '. ');
            $tembusanTable->addCell()->addText($tembusan->tembusan);
            $index++;
        }
        $x = Pengajuan::tglFormatter($pengajuan->tgl_berangkat,'d F');
        $y = Pengajuan::tglFormatter($pengajuan->tgl_kembali,'d F Y');
        $perintah_tgl = "$x - $y";
        $paraf_jenis = Pengajuan::cetakspt_select[$paraf];
        switch ($paraf) {
            case 'gubernur':
                $gubernur = Kepegawaian::find(32);
                $paraf_nama = $gubernur->nama;
                $paraf_pangkat = $gubernur->pangkat;
                $paraf_nip = $gubernur->nip;
                break;
            
            case 'wakil_gubernur':
                $wakil_gubernur = Kepegawaian::find(33);
                $paraf_nama = $wakil_gubernur->nama;
                $paraf_pangkat = $wakil_gubernur->pangkat;
                $paraf_nip = $wakil_gubernur->nip;
                break;
            
            case 'inspektur':
                $inspektur = Kepegawaian::find(2);
                $paraf_nama = $inspektur->nama;
                $paraf_pangkat = $inspektur->pangkat;
                $paraf_nip = $inspektur->nip;
                break;
            
            default:
                $inspektur = Kepegawaian::find(2);
                $paraf_nama = $inspektur->nama;
                $paraf_pangkat = $inspektur->pangkat;
                $paraf_nip = $inspektur->nip;
                break;
        }

        $tgl = $pengajuan->getTglTerbitAtribute();
        $templateProcessor->setValues([
            'no_spt' => $pengajuan->no_spt,
            'nama_kegiatan' => $pengajuan->nama_kegiatan,
            'tgl' => $tgl,
            'perintah_tgl' => $perintah_tgl,
            'paraf_jenis' => $paraf_jenis,
            'paraf_nama' => $paraf_nama,
            'paraf_pangkat' => $paraf_pangkat,
            'paraf_nip' => $paraf_nip,
        ]);
        $templateProcessor->setComplexBlock('anggota', $anggotaTable);
        $templateProcessor->setComplexBlock('dasar', $dasarTable);
        $templateProcessor->setComplexBlock('tembusan', $tembusanTable);
        $hash = $pengajuan->id . Carbon::now();
        $filename = "SPT_" . hash('sha1', $hash);
        header("Content-Disposition: attachment; filename=" . $filename . ".docx");
        return $templateProcessor->saveAs('php://output');
    }
}

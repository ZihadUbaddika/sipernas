<?php

namespace Database\Seeders;

use App\Models\UserManagement\Kepegawaian;
use Illuminate\Database\Seeder;

class KepegawaiansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff =
            [
                [
                    'id'                  => 1,
                    'nama'                => 'M. Topan S',
                    'nip'                 => '198407072008011009',
                    'pangkat'             => 'Pengatur Muda Tingkat I',
                    'golongan'            => 'II/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'topan@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 2,
                    'nama'                => 'Ir. Fredy SM., M.M.',
                    'nip'                 => '196502021990101001',
                    'pangkat'             => 'Pembina Utama Madya',
                    'golongan'            => 'IV/D',
                    'foto'                => 'default.jpg',
                    'email'               => 'fredy@gmail.com',
                    'no_hp'               => '087657356332',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 3,
                    'nama'                => 'Affan Erie Erya, S.H',
                    'nip'                 => '196410071990011001',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'affanerie@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 4,
                    'nama'                => 'Pirwansyah, S.H',
                    'nip'                 => '196503101987111001',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'pirwansyah@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 5,
                    'nama'                => 'Ir. Ahmad Samti, M.T',
                    'nip'                 => '196507111997031002',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'ahmadsamti@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 6,
                    'nama'                => 'Drs. Andrian Syarif, M.IP',
                    'nip'                 => '196911101990031008',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'andriansyarif@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 7,
                    'nama'                => 'Wayan Hari Kurniawan, S.SSTP., M.IP',
                    'nip'                 => '199005192010011001',
                    'pangkat'             => 'Penata',
                    'golongan'            => 'III/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'wayanhari@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 8,
                    'nama'                => 'Ujang Misron, S.H,',
                    'nip'                 => '196311221992031003',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'ujangmisron@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 9,
                    'nama'                => 'Flora Enggelina, S.E',
                    'nip'                 => '196411111993112001',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'flora@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 10,
                    'nama'                => 'Suresmi, S.E., M.M',
                    'nip'                 => '196508271992032004',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'suresmi@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 11,
                    'nama'                => 'Muh. Akbar Sholeh, S.Si, M.S.Ak',
                    'nip'                 => '198008122003121006',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'akbarsholeh@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 12,
                    'nama'                => 'Zalliawaty, S.Sos',
                    'nip'                 => '197508242000032003',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'zalliawaty@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 13,
                    'nama'                => 'Neksen, S.Sos',
                    'nip'                 => '197309131998031009',
                    'pangkat'             => 'Pembina',
                    'golongan'            => 'IV/A',
                    'foto'                => 'default.jpg',
                    'email'               => 'neksen@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 14,
                    'nama'                => 'Tri Kancono, S.H., M.M.',
                    'nip'                 => '196403141991031005',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'trikancono@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 15,
                    'nama'                => 'Iva Nova Yalina, S.H., M.H.',
                    'nip'                 => '196509221993122001',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'ivanovayalina@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 16,
                    'nama'                => 'Ratna Yulisa Raspati, S.H.',
                    'nip'                 => '196907191995032003',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'ratnayulisa@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 17,
                    'nama'                => 'Devianti, S.H',
                    'nip'                 => '197211212002122005',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'devianti@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 18,
                    'nama'                => 'Diyah Herawati, S.T., M.M',
                    'nip'                 => '197211212002122005',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'diyah@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 19,
                    'nama'                => 'Zulkipli Agung, S.H',
                    'nip'                 => '196507161986031007',
                    'pangkat'             => 'Penata Tingkat I',
                    'golongan'            => 'III/D',
                    'foto'                => 'default.jpg',
                    'email'               => 'zulkipliagung@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 20,
                    'nama'                => 'Mardias, S.E., M.M.',
                    'nip'                 => '196210211989031002',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'mardias@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 21,
                    'nama'                => 'M. Sjaifoedin Z.H.P, S.T',
                    'nip'                 => '196506131997031002',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'sjaifoedin@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 22,
                    'nama'                => 'Harun Syukri, S.H',
                    'nip'                 => '196706261993111001',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'harun@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 23,
                    'nama'                => 'Zainal Abidin, S.H',
                    'nip'                 => '196906141998031007',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'zainalabidin@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 24,
                    'nama'                => 'Susanti Dwiharsandi, S.E., M.M',
                    'nip'                 => '197509302005012011',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'susanti@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 25,
                    'nama'                => 'Bunaiyah, S.E',
                    'nip'                 => '196412131993032003',
                    'pangkat'             => 'Pembina',
                    'golongan'            => 'IV/A',
                    'foto'                => 'default.jpg',
                    'email'               => 'bunaiyah@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 26,
                    'nama'                => 'Wiku Cendikiawan.P, S.E ',
                    'nip'                 => '196207061990031007',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'wiku@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 27,
                    'nama'                => 'Drs. Henry Iswandi, M.Si',
                    'nip'                 => '196301231983031005',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'henry@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 28,
                    'nama'                => 'Wamuhayya, S.H',
                    'nip'                 => '196411061995012001',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'wamuhayya@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 29,
                    'nama'                => 'Dra. Hidayatika, M.Si',
                    'nip'                 => '196807161989092002',
                    'pangkat'             => 'Pembina Utama Muda',
                    'golongan'            => 'IV/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'hidayatika@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 30,
                    'nama'                => 'Dra. Amrina Sari',
                    'nip'                 => '196709251994031005',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'amrinasari@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 31,
                    'nama'                => 'Drs. Dafeta Ali',
                    'nip'                 => '196912211992031005',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'dafeta@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 32,
                    'nama'                => 'Ir. H. Arinal Djunaidi',
                    'nip'                 => '196912211992031005',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'arinal@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 33,
                    'nama'                => 'Hj. Chusnunia Chalim, S.H., M.Si., M.Kn., Ph.D.',
                    'nip'                 => '196912211992031005',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'chusnunia@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 34,
                    'nama'                => 'Drs. Sahat Paulus Naipospos,M.M.',
                    'nip'                 => '196712101989091001',
                    'pangkat'             => 'Pembina Tingkat I',
                    'golongan'            => 'IV/B',
                    'foto'                => 'default.jpg',
                    'email'               => 'sahat@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 35,
                    'nama'                => 'Rika Yuniarti Akma, S.E',
                    'nip'                 => '197405232007012018',
                    'pangkat'             => 'Penata Tingkat I',
                    'golongan'            => 'III/D',
                    'foto'                => 'default.jpg',
                    'email'               => 'rika@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 36,
                    'nama'                => 'Iwan Meylani,S.STP',
                    'nip'                 => '198405262002121001',
                    'pangkat'             => 'Penata Tingkat I',
                    'golongan'            => 'III/D',
                    'foto'                => 'default.jpg',
                    'email'               => 'iwan@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
                [
                    'id'                  => 37,
                    'nama'                => 'Wayan Hari Kurniawan, S.SSTP., M.IP',
                    'nip'                 => '199005192010011001',
                    'pangkat'             => 'Penata',
                    'golongan'            => 'III/C',
                    'foto'                => 'default.jpg',
                    'email'               => 'wayanhari@gmail.com',
                    'no_hp'               => '082176544567',
                    'created_at'          => '2019-04-15 19:13:32',
                    'updated_at'          => '2019-04-15 19:13:32',
                ],
            ];
        Kepegawaian::insert($staff);
    }
}

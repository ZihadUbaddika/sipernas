<?php

namespace Database\Seeders;

use App\Models\UserManagement\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'         => 1,
                'wilayah_id' => 1,
                'tipe'       => 'admin',
                'title'      => 'Admin',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'wilayah_id' => 1,
                'tipe'       => 'inspektur',
                'title'      => 'Inspektur',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'wilayah_id' => 1,
                'tipe'       => 'irban',
                'title'      => 'Irban Wilayah 1',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'wilayah_id' => 2,
                'tipe'       => 'irban',
                'title'      => 'Irban Wilayah 2',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 5,
                'wilayah_id' => 3,
                'tipe'       => 'irban',
                'title'      => 'Irban Wilayah 3',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 6,
                'wilayah_id' => 4,
                'tipe'       => 'irban',
                'title'      => 'Irban Wilayah 4',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 7,
                'wilayah_id' => 1,
                'tipe'       => 'pptk',
                'title'      => 'PPTK',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 8,
                'wilayah_id' => 1,
                'tipe'       => 'pegawai',
                'title'      => 'Pegawai Wilayah 1',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 9,
                'wilayah_id' => 2,
                'tipe'       => 'pegawai',
                'title'      => 'Pegawai Wilayah 2',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 10,
                'wilayah_id' => 3,
                'tipe'       => 'pegawai',
                'title'      => 'Pegawai Wilayah 3',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 11,
                'wilayah_id' => 4,
                'tipe'       => 'pegawai',
                'title'      => 'Pegawai Wilayah 4',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 12,
                'wilayah_id' => 1,
                'tipe'       => 'gubernur',
                'title'      => 'Gubernur Lampung',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 13,
                'wilayah_id' => 1,
                'tipe'       => 'wakil_gubernur',
                'title'      => 'Wakil Gubernur Lampung',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 14,
                'wilayah_id' => 1,
                'tipe'       => 'sekretaris',
                'title'      => 'Sekretaris',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 15,
                'wilayah_id' => 1,
                'tipe'       => 'subbag_umum',
                'title'      => 'Subbag. Umum dan Keuangan',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 16,
                'wilayah_id' => 1,
                'tipe'       => 'subbag_analisis',
                'title'      => 'Subbag. Analisis dan Evaluasi',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
            [
                'id'         => 17,
                'wilayah_id' => 1,
                'tipe'       => 'subbag_perencanaan',
                'title'      => 'Subbag. Perencanaan',
                'created_at' => '2019-04-15 19:13:32',
                'updated_at' => '2019-04-15 19:13:32',
                'deleted_at' => null,
            ],
        ];
        Role::insert($roles);
    }
}

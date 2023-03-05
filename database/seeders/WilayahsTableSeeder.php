<?php

namespace Database\Seeders;

use App\Models\UserManagement\Wilayah;
use Illuminate\Database\Seeder;

class WilayahsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilayahs = [
            [
                'id'        =>1,
                'wilayah'   =>'Wilayah 1',
            ],
            [
                'id'        =>2,
                'wilayah'   =>'Wilayah 2',
            ],
            [
                'id'        =>3,
                'wilayah'   =>'Wilayah 3',
            ],
            [
                'id'        =>4,
                'wilayah'   =>'Wilayah 4',
            ],
        ];
        Wilayah::insert($wilayahs);
    }
}

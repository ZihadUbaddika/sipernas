<?php

namespace Database\Seeders;

use App\Models\UserManagement\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        User::findOrFail(1)->roles()->sync([1]);
        //Inspektur
        User::findOrFail(2)->roles()->sync([2]);
        //Irban Wil 1
        User::findOrFail(3)->roles()->sync([3]);
        //Irban Wil 2
        User::findOrFail(4)->roles()->sync([4]);
        //Irban Wil 3
        User::findOrFail(5)->roles()->sync([5]);
        //Irban Wil 4
        User::findOrFail(6)->roles()->sync([6]);
        //PPTK
        User::findOrFail(7)->roles()->sync([7]);
        //Peg WIl 1
        $pegawai_wil1 = [8,9,10,11,12,13];
        for ($i=0; $i < count($pegawai_wil1); $i++) { 
            User::findOrFail($pegawai_wil1[$i])->roles()->sync([8]);
        }
        //Peg WIl 2
        $pegawai_wil2 = [14,15,16,17,18,19];
        for ($i=0; $i < count($pegawai_wil2); $i++) { 
            User::findOrFail($pegawai_wil2[$i])->roles()->sync([9]);
        }
        //Peg WIl 3
        $pegawai_wil3 = [20,21,22,23,24,25];
        for ($i=0; $i < count($pegawai_wil3); $i++) { 
            User::findOrFail($pegawai_wil3[$i])->roles()->sync([10]);
        }
        //Peg WIl 4
        $pegawai_wil4 = [26,27,28,29,30,31];
        for ($i=0; $i < count($pegawai_wil4); $i++) { 
            User::findOrFail($pegawai_wil4[$i])->roles()->sync([11]);
        }
        User::findOrFail(34)->roles()->sync([14]);
        User::findOrFail(35)->roles()->sync([15]);
        User::findOrFail(36)->roles()->sync([16]);
        User::findOrFail(37)->roles()->sync([17]);
    }
}

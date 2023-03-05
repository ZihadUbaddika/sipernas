<?php

namespace Database\Seeders;

use App\Models\UserManagement\Permission;
use App\Models\UserManagement\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        //Inspektur
        $inspektur_permissions = Permission::all()->whereIn('id',[23,24,26,31,36,100]);
        Role::findOrFail(2)->permissions()->sync($inspektur_permissions->pluck('id'));
        //Irban
        $irban_permissions = Permission::all()->whereIn('id',[23,24,26,31,36,101]);
        //Irban Wil 1
        Role::findOrFail(3)->permissions()->sync($irban_permissions->pluck('id'));
        //Irban Wil 2
        Role::findOrFail(4)->permissions()->sync($irban_permissions->pluck('id'));
        //Irban Wil 3
        Role::findOrFail(5)->permissions()->sync($irban_permissions->pluck('id'));
        //Irban Wil 4
        Role::findOrFail(6)->permissions()->sync($irban_permissions->pluck('id'));
        //PPTK
        $pptk_permissions = Permission::all()->whereIn('id',[27,28,29,31,103]);
        Role::findOrFail(7)->permissions()->sync($pptk_permissions->pluck('id'));
        //Pegawai
        $pegawaiwil1_permissions = Permission::all()->whereIn('id',[22,23,24,25,26,32,33,34,35,36,200,201]);
        $pegawaiwil2_permissions = Permission::all()->whereIn('id',[22,23,24,25,26,32,33,34,35,36,200,202]);
        $pegawaiwil3_permissions = Permission::all()->whereIn('id',[22,23,24,25,26,32,33,34,35,36,200,203]);
        $pegawaiwil4_permissions = Permission::all()->whereIn('id',[22,23,24,25,26,32,33,34,35,36,200,204]);
        //Pegawai Wil 1
        Role::findOrFail(8)->permissions()->sync($pegawaiwil1_permissions->pluck('id'));
        // Pegawai Wil 2
        Role::findOrFail(9)->permissions()->sync($pegawaiwil2_permissions->pluck('id'));
        //Pegawai Wil 3
        Role::findOrFail(10)->permissions()->sync($pegawaiwil3_permissions->pluck('id'));
        // Pegawai Wil 4
        Role::findOrFail(11)->permissions()->sync($pegawaiwil4_permissions->pluck('id'));
    }
}

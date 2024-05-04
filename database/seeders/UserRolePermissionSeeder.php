<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        
        try {
            $default_user_value = [
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ];

            $super_admin = User::create(
                array_merge([
                    'email' => 'admin',
                    'name' => 'admin'
                ], $default_user_value)
            );
            $admin_kec = User::create(
                array_merge([
                    'email' => 'admin_kec',
                    'name' => 'admin_kec'
                ], $default_user_value)
            );
            $admin_kab = User::create(
                array_merge([
                    'email' => 'admin_kab',
                    'name' => 'admin_kab'
                ], $default_user_value)
            );
            $admin_opd = User::create(
                array_merge([
                    'email' => 'admin_opd',
                    'name' => 'admin_opd'
                ], $default_user_value)
            );
            
            $roleSuperAdmin = Role::create(['name' => 'super_admin']);
            $roleAdminKec = Role::create(['name' => 'admin_kec']);
            $roleAdminKab = Role::create(['name' => 'admin_kab']);
            $roleAdminOPD = Role::create(['name' => 'admin_opd']);

            $menus = ['Dashboard', 'Rekap Laporan', 'Data master', 'Configuration'];

            foreach ($menus as $menu) {
                Permission::create(['name' => $menu]);
                $roleSuperAdmin->givePermissionTo($menu);
            }
            
            $menus2 = ['Pelaporan', 'Tanggapan', 'Kategori', 'Status', 'Kewenangan', 'Region', 'User', 'Group User'];
            
            foreach ($menus2 as $m) {
                Permission::create(['name' => $m . 'crud']);
                Permission::create(['name' => $m . ' Read']);
                Permission::create(['name' => $m . ' Create']);
                Permission::create(['name' => $m . ' Update']);
                Permission::create(['name' => $m . ' Delete']);
                
                $roleSuperAdmin->givePermissionTo($m . 'crud');
                $roleSuperAdmin->givePermissionTo($m . ' Read');
                $roleSuperAdmin->givePermissionTo($m . ' Create');
                $roleSuperAdmin->givePermissionTo($m . ' Update');
                $roleSuperAdmin->givePermissionTo($m . ' Delete');
            }
            

            $super_admin->assignRole($roleSuperAdmin);
            $admin_kec->assignRole($roleAdminKec);
            $admin_kab->assignRole($roleAdminKab);
            $admin_opd->assignRole($roleAdminOPD);

            Status::insert([
                [
                    'name' => 'Belum Ditanggapi',
                    'created_at' => now(),
                    'color' => 'red',
                    'class' => 'danger',
                    'icon' => 'bxs-calendar-x'
                ],
                [
                    'name' => 'Dalam Penanganan',
                    'created_at' => now(),
                    'color' => 'yellow',
                    'class' => 'warning',
                    'icon' => 'bx-hourglass',
                ],
                [
                    'name' => 'Dalam Perencanaan',
                    'created_at' => now(),
                    'color' => 'blue',
                    'class' => 'info',
                    'icon' => 'bxs-hourglass-bottom',
                ],
                [
                    'name' => 'Telah Diselesaikan',
                    'created_at' => now(),
                    'color' => 'green',
                    'class' => 'success',
                    'icon' => 'bxs-calendar-check',
                ]
            ]);            

            DB::commit();
            
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
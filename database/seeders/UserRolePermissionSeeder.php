<?php

namespace Database\Seeders;

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

            $permission = Permission::create(['name' => 'read_role']);
            $permission = Permission::create(['name' => 'create_role']);
            $permission = Permission::create(['name' => 'update_role']);
            $permission = Permission::create(['name' => 'delete_role']);

            $roleSuperAdmin->givePermissionTo('read_role');
            $roleSuperAdmin->givePermissionTo('create_role');
            $roleSuperAdmin->givePermissionTo('update_role');
            $roleSuperAdmin->givePermissionTo('delete_role');

            $super_admin->assignRole($roleSuperAdmin);
            $admin_kec->assignRole($roleAdminKec);
            $admin_kab->assignRole($roleAdminKab);
            $admin_opd->assignRole($roleAdminOPD);

            DB::commit();
            
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
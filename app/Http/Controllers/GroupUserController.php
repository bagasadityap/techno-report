<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GroupUserController extends Controller
{
    public function index() {
        $page = 'configuration';
        $roles = Role::all();
        $permissions = Permission::all();
        return view('group.dashboard', ["page"=> $page, "roles"=> $roles, "permissions"=> $permissions]);
    }

    public function edit(Request $request, $id) {
        // dd($request);
        
        try {
            DB::beginTransaction();
    
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            
            $permissions = $request->all();
    
            foreach ($permissions as $fieldName => $value) {
                if ($fieldName !== '_token') {
                    $role->givePermissionTo($value);
                }
            }
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Permission berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Pembaruan permission gagal: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index() {
        $page = 'admin';
        $user = User::all();
        return view("admin.dashboard", ["users"=> $user, "page"=> $page]);
    }
    
    public function add() {
        $page = 'admin';
        return view("admin.add", ["page"=> $page]);
    }
    
    public function update($id) {
        $page = 'admin';
        $user = User::where('id', $id)->firstOrFail();
        return view("admin.update", ["page"=> $page], compact("user"));
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string',
            'role' => 'required'
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role);
        }
    
        return redirect('/administrator');
    }
    
    public function update_store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'role' => 'required',
            'status' => 'required'
        ]);
    
        $user = User::findOrFail($request->id);
    
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        $user->syncRoles([$request->role]);
    
        $user->status = $request->status;
    
        $user->save();
    
        return redirect('/administrator');
    }    

    public function delete($id) {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
        }
        return redirect('/administrator');
    }    
}

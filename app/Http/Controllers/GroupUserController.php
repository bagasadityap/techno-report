<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class GroupUserController extends Controller
{
    public function index() {
        $page = 'configuration';
        $roles = Role::all();
        return view('group.dashboard', ["page"=> $page, "roles"=> $roles]);
    }
}

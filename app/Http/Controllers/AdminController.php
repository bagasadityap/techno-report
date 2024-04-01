<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $page = 'admin';
        $user = User::all();
        return view("admin.dashboard", ["user"=> $user, "page"=> $page]);
    }
}

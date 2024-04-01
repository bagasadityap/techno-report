<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $page = 'main';
        return view("main.dashboard", compact("page"));
    }
}

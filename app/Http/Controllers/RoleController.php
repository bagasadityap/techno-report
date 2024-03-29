<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware("can:create role")->only("create");
    }
    
    public function index() {
        return 'role page';
    }
}

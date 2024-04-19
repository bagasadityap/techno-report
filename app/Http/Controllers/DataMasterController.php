<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Status;
use App\Models\Authority;
use App\Models\Region;

class DataMasterController extends Controller
{
    public function category () {
        $page = 'data';
        $category = Category::all();
        return view('data.category.dashboard', ['page' => $page, 'category'=> $category]);
    }
    
    public function status () {
        $page = 'data';
        $status = Status::all();
        return view('data.category.dashboard', ['page' => $page, 'status'=> $status]);
    }
    
    public function authority () {
        $page = 'data';
        $authority = Authority::all();
        return view('data.category.dashboard', ['page' => $page, 'authority'=> $authority]);
    }
    
    public function region () {
        $page = 'data';
        $region = Region::all();
        return view('data.category.dashboard', ['page' => $page, 'region'=> $region]);
    }

    public function add_category (Request $request) {
        $page = 'data';
        $request->validate([
            'name'=> 'required',
        ]);
        Category::create([
            'name'=> $request->name,
        ]);
        return redirect('/category');
    }
}

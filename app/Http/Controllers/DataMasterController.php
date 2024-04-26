<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Status;
use App\Models\Authority;
use App\Models\Region;
use Illuminate\Support\Facades\Session;

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
        return view('data.status.dashboard', ['page' => $page, 'status'=> $status]);
    }
    
    public function authority () {
        $page = 'data';
        $authority = Authority::all();
        return view('data.authority.dashboard', ['page' => $page, 'authority'=> $authority]);
    }
    
    public function region () {
        $page = 'data';
        $region = Region::all();
        return view('data.region.dashboard', ['page' => $page, 'region'=> $region]);
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
    
    public function add_status(Request $request) {
        $validatedData = $request->validate([
            'name'=> 'required',
            'color' => 'required',
            'class' => 'required',
            'icon' => 'required',
        ]);
    
        try {
            Status::create($validatedData);
            
            Session::flash('success', 'Status added successfully!');
        } catch (\Exception $e) {
            Session::flash('error', 'An error occurred while adding the status.');
        }
    
        return redirect('/status')->withInput();
    }
    
    public function add_authority (Request $request) {
        $page = 'data';
        $request->validate([
            'name'=> 'required',
        ]);
        Authority::create([
            'name'=> $request->name,
        ]);
        return redirect('/authority');
    }
    
    public function add_region (Request $request) {
        $page = 'data';
        $request->validate([
            'name'=> 'required',
        ]);
        Region::create([
            'name'=> $request->name,
        ]);
        return redirect('/region');
    }
}

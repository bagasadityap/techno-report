<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Status;
use App\Models\Authority;
use App\Models\Region;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

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

        $validatedData = $request->validate([
            'name'=> 'required',
        ]);
        
        try {
            Category::create($validatedData);
            
            Session::flash('success', 'Kategori berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kategori.');
        } 
        return redirect('/category');
    }
    
    public function add_status(Request $request) {
        try {
            $validatedData = $request->validate([
                'name'=> 'required',
                'color' => 'required',
                'class' => 'required',
                'icon' => 'required',
            ]);
            
            Status::create($validatedData);
            
            session()->flash('success', 'Status berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan status.');
        }
    
        return redirect('/status')->withInput();
    }
    
    public function add_authority(Request $request) {
        try {
            $validatedData = $request->validate([
                'name'=> 'required',
            ]);
    
            Authority::create($validatedData);
    
            session()->flash('success', 'Kewenangan berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan kewenangan.');
        }
    
        return redirect('/authority')->withInput();
    }
    
    public function add_region(Request $request) {
        try {
            $validatedData = $request->validate([
                'name'=> 'required',
            ]);
    
            Region::create($validatedData);
    
            session()->flash('success', 'Region berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan region.');
        }
    
        return redirect('/region')->withInput();
    }

    public function update_category(Request $request, $id) {
        $page = 'data';
        $request->validate([
            'name'=> 'required',
        ]);
    
        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name'=> $request->name,
            ]);
            
            session()->flash('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the category.');
        }
    
        return redirect('/category');
    }
    
    public function update_status(Request $request, $id) {
        $validatedData = $request->validate([
            'name'=> 'required',
            'color' => 'required',
            'class' => 'required',
            'icon' => 'required',
        ]);
    
        try {
            $status = Status::findOrFail($id);
            $status->update($validatedData);
            
            session()->flash('success', 'Status updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the status.');
        }
    
        return redirect('/status');
    }
    
    public function update_authority(Request $request, $id) {
        $page = 'data';
        $request->validate([
            'name'=> 'required',
        ]);
    
        try {
            $authority = Authority::findOrFail($id);
            $authority->update([
                'name'=> $request->name,
            ]);
            
            session()->flash('success', 'Authority updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the authority.');
        }
    
        return redirect('/authority');
    }
    
    public function update_region(Request $request, $id) {
        $page = 'data';
        $request->validate([
            'name'=> 'required',
        ]);
    
        try {
            $region = Region::findOrFail($id);
            $region->update([
                'name'=> $request->name,
            ]);
            
            session()->flash('success', 'Region updated successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while updating the region.');
        }
    
        return redirect('/region');
    }
    
    public function delete_category($id) {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            
            session()->flash('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the category.');
        }
    
        return redirect('/category');
    }
    
    public function delete_status($id) {
        try {
            $status = Status::findOrFail($id);
            $status->delete();
            
            session()->flash('success', 'Status deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the status.');
        }
    
        return redirect('/status');
    }
    
    public function delete_authority($id) {
        try {
            $authority = Authority::findOrFail($id);
            $authority->delete();
            
            session()->flash('success', 'Authority deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the authority.');
        }
    
        return redirect('/authority');
    }
    
    public function delete_region($id) {
        try {
            $region = Region::findOrFail($id);
            $region->delete();
            
            session()->flash('success', 'Region deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting the region.');
        }
    
        return redirect('/region');
    }    
}

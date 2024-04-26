<?php

namespace App\Http\Controllers;

use App\Models\Authority;
use App\Models\Category;
use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{
    public function index() {
        $page = 'report';
        $reports = Report::all();
        return view("report.dashboard", ["page"=> $page, "reports"=> $reports]);
    }

    public function add() {
        $page = 'report';
        $categories = Category::all();
        $authorities = Authority::all();
        $status = Status::first();
        return view("report.add", ["page"=> $page, "categories"=> $categories, "authorities"=> $authorities, "status"=> $status]);     
    }
    
    public function update($id) {
        $page = 'report';
        $report = Report::where('id', $id)->firstOrFail();
        $categories = Category::all();
        $authorities = Authority::all();
        $status = Status::first();
        return view("report.update", ["page"=> $page, "report"=>$report, "categories"=> $categories, "authorities"=> $authorities, "status"=> $status]);     
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'date' => 'required|date',
                'category_id' => 'required|exists:categories,id',
                'authority_id' => 'required|exists:authorities,id',
                'photo' => 'nullable|image|max:2048',
                'detail' => 'required',
            ]);

            $user_id = auth()->id();
            $status_id = Status::first()->id;

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('report', 'public');
            } else {
                $photoPath = null;
            }

            $report = new Report();
            $report->name = $validatedData['name'];
            $report->detail = $validatedData['detail'];
            $report->date = $validatedData['date'];
            $report->photo = $photoPath;
            $report->user_id = $user_id;
            $report->category_id = $validatedData['category_id'];
            $report->authority_id = $validatedData['authority_id'];
            $report->status_id = $status_id;
            $report->save();

            return redirect('/report')->with('success', 'Report created successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Error creating report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    public function update_store(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'date' => 'required|date',
                'category_id' => 'required|exists:categories,id',
                'authority_id' => 'required|exists:authorities,id',
                'photo' => 'nullable|image|max:2048',
                'detail' => 'required',
            ]);

            $user_id = auth()->id();
            $status_id = Status::first()->id;

            $report = Report::findOrFail($id);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('report', 'public');
                if ($report->photo) {
                    Storage::disk('public')->delete($report->photo);
                }
                $report->photo = $photoPath;
            }

            $report->name = $validatedData['name'];
            $report->detail = $validatedData['detail'];
            $report->date = $validatedData['date'];
            $report->user_id = $user_id;
            $report->category_id = $validatedData['category_id'];
            $report->authority_id = $validatedData['authority_id'];
            $report->status_id = $status_id;
            $report->save();

            return redirect('/report')->with('success', 'Report updated successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Error updating report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    public function delete($id) {
        try {
            $report = Report::findOrFail($id);
    
            if ($report->photo) {
                Storage::disk('public')->delete($report->photo);
            }
    
            $report->delete();
    
            return redirect('/report')->with('success', 'Report deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the report.');
        }
    }
}

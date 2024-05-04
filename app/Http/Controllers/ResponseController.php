<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Response;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ResponseController extends Controller
{
    public function index($id) {
        $page = 'report';
        $report = Report::where('id', $id)->firstOrFail();
        $response = Response::where('report_id', $id)->get();
        $statuses = Status::all();
        return view("report.response.dashboard", ["report"=> $report,"page"=> $page,"response"=> $response, "statuses"=> $statuses]);
    }

    public function store(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'date' => 'required|date',
                'image' => 'nullable|image|max:2048',
                'description' => 'required',
                'status_id' => 'required|exists:statuses,id',
            ]);

            $user_id = auth()->id();

            if ($request->hasFile('image')) {
                $photoPath = $request->file('image')->store('response', 'public');
            } else {
                $photoPath = null;
            }

            $response = new Response();
            $response->date = $validatedData['date'];
            $response->description = $validatedData['description'];
            $response->image = $photoPath;
            $response->report_id = $id;
            $response->user_id = $user_id;
            $response->save();

            $report = Report::findOrFail($id);
            $report->status_id = $validatedData['status_id'];
            $report->save();

            return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Error creating report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Kesalahan saat menambahkan laporan.');
        }
    }

    public function update(Request $request, $id, $id2)
    {
        try {
            $validatedData = $request->validate([
                'date' => 'required|date',
                'image' => 'nullable|image|max:2048',
                'status_id' => 'required|exists:statuses,id',
                'desc' => 'required',
            ]);

            $response = Response::findOrFail($id2);

            if ($request->hasFile('image')) {
                $photoPath = $request->file('image')->store('response', 'public');
                if ($response->image) {
                    Storage::disk('public')->delete($response->image);
                }
                $response->image = $photoPath;
            }

            $response->date = $validatedData['date'];
            $response->description = $validatedData['desc'];
            $response->save();

            $report = Report::findOrFail($id);
            $report->status_id = $validatedData['status_id'];
            $report->save();

            return redirect()->back()->with('success', 'Tanggapan berhasil diperbarui!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Error updating response: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Kesalahan saat memperbarui tanggapan.');
        }
    }

    public function delete($id, $id2) {
        try {
            $response = Response::findOrFail($id2);
    
            if ($response->image) {
                Storage::disk('public')->delete($response->image);
            }
    
            $response->delete();
    
            return redirect()->back()->with('success', 'Tanggapan berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error deleting report: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Kesalahan saat menghapus tanggapan.');
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index() {
        $page = 'main';
        $today = Report::whereDate('created_at', Carbon::today())->count();

        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        $thisWeekSum = Report::whereBetween('created_at', [$start, $end])->count();
        $thisWeek = Report::whereBetween('created_at', [$start, $end])->get();

        $thisMonth = Report::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        
        $statuses = Status::all();
        
        $status = DB::table('reports')
            ->select(DB::raw('count(*) as c, status_id'))
            ->groupBy('status_id')
            ->get();

        // dd($status);
    
        return view("main.dashboard", ['page' => $page, 'today' => $today, 'thisWeekSum' => $thisWeekSum, 'thisMonth' => $thisMonth, 'thisWeek' => $thisWeek, 'statuses'=>$statuses, 'status' => $status]);
    }
}

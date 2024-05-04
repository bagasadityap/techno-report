<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class RecapReportController extends Controller
{
    public function index() {
        $page = 'recap';
        $reports = Report::all();
        return view("recap_report.dashboard", ["page"=> $page, "reports"=> $reports]);
    }

    public function download() {
        return Excel::download(new ReportExport, 'rekap-laporan-' . date('d-m-Y') . '.xlsx');
    }
}

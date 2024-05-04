<?php

namespace App\Exports;

use App\Models\Report;
// use Carbon\Traits\Date;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    public function headings(): array
    {
        return [
            "No",
            "Judul",
            "Tanggal",
            "Nama Pelapor",
            "Kategori",
            "Kewenangan",
            "Status",
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            "1" => [
                'row_height' => 30
            ],
            "A1:G1" => [
                "font" => [
                    "bold" => true,
                    "size" => 14
                ],
                "fill" => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        "rgb" => "696cff"
                    ]
                ]
            ]
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $reports = Report::all(); // Retrieve all reports
    
        return $reports->map(function ($report, $index) {
            return [
                $index + 1,
                $report->name,
                Carbon::parse($report->date)->format('Y-m-d H:i:s'),
                $report->user->name,
                $report->category->name,
                $report->authority->name,
                $report->status->name,
            ];
        });
    }
}

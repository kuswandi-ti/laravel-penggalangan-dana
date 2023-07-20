<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ReportExport implements FromArray, WithHeadings, WithColumnFormatting, WithColumnWidths
{

    private $start;
    private $end;
    private $data;

    public function __construct(string $start, string $end, array $data)
    {
        $this->start = $start;
        $this->end = $end;
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            ['Laporan Penggalangan Dana'],
            ['Tanggal ' . date_format_id($this->start) . ' s/d Tanggal ' . date_format_id($this->end)],
            [''],
            [''],
            ['No', 'Tanggal', 'Pemasukan', 'Pengeluaran', 'Sisa Kas'],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 20,
            'C' => 30,
            'D' => 30,
            'E' => 30,
        ];
    }
}

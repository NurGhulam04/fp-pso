<?php

namespace App\Exports;

use App\Models\book_issue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthWiseReportExport implements FromCollection, WithHeadings
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        // Ambil data book_issue bulan tertentu beserta relasi student dan book
        $bookIssues = book_issue::with(['student', 'book'])
            ->where('issue_date', 'LIKE', $this->month . '%')
            ->latest()
            ->get();

        // Map data ke format array sesuai kolom yang diinginkan
        return $bookIssues->map(function($item, $key) {
            return [
                'S.No' => $key + 1,
                'Student Name' => $item->student->name ?? '',
                'Book Name' => $item->book->name ?? '',
                'Phone' => $item->student->phone ?? '',
                'Email' => $item->student->email ?? '',
                'Issue Date' => $item->issue_date->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Student Name',
            'Book Name',
            'Phone',
            'Email',
            'Issue Date',
        ];
    }
}

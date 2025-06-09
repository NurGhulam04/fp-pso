<?php

namespace App\Exports;

use App\Models\book_issue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DateWiseReportExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return book_issue::with('student', 'book')
            ->whereDate('issue_date', $this->date)
            ->get()
            ->map(function ($book) {
                return [
                    'Student Name' => $book->student->name,
                    'Book Name'    => $book->book->name,
                    'Phone'        => $book->student->phone,
                    'Email'        => $book->student->email,
                    'Issue Date'   => $book->issue_date->format('Y-m-d'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Student Name', 'Book Name', 'Phone', 'Email', 'Issue Date'];
    }
}

<?php

namespace App\Exports;

use App\Models\book_issue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NotReturnedReportExport implements FromCollection, WithHeadings, WithMapping
{
public function collection()
{
    return \App\Models\book_issue::with(['student', 'book'])->get();
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
            'Return Date',
            'Over Days',
        ];
    }

    public function map($book_issue): array
{
    $issueDate = $book_issue->issue_date ? $book_issue->issue_date->format('d M, Y') : '';
    $returnDate = $book_issue->return_date ? $book_issue->return_date->format('d M, Y') : '';

    $overDays = 0;
    if ($book_issue->return_date && now()->gt($book_issue->return_date)) {
        $overDays = now()->diffInDays($book_issue->return_date);
    }

    return [
        $book_issue->id,
        $book_issue->student->name ?? '-',
        $book_issue->book->name ?? '-',
        $book_issue->student->phone ?? '-',
        $book_issue->student->email ?? '-',
        $issueDate,
        $returnDate,
        $overDays . ' days',
    ];
}
}

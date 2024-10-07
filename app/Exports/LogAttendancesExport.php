<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogAttendancesExport implements FromCollection, WithHeadings
{
    protected $attendances;

    public function __construct($attendances)
    {
        $this->attendances = $attendances;
    }

    /**
     * Return a collection of data to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->attendances->map(function ($attendance) {
            return [
                $attendance->student->name, // pastikan relasi student ada
                $attendance->information,
                $attendance->note,
            ];
        });
    }

    /**
     * Define the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Student Name',
            'Information',
            'Note',
        ];
    }
}

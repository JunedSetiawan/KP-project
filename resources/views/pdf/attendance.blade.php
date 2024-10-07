<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            page-break-inside: avoid;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 2px;
            font-size: 9px;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            margin-bottom: 20px;
        }
        .header h3 {
            margin: 0;
            text-align: center;
        }
        .notes {
            margin-top: 10px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>SMP NEGERI 1 PONOROGO</h3>
        <p>KELAS (ICP): 7A</p>
        <p>Wali Kelas: FINA MASKURYATI, S.Pd., Gr</p>
        <p>Bulan: {{ $monthName }} {{ $year }}</p>
    </div>

    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Peserta</th>
            <th>L/P</th>
            @for ($i = 1; $i <= $daysInMonth; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ($attendances as $studentId => $attendanceRecords)
            @php
                $attendance = $attendanceRecords->first(); // Get the first record to display student info
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $attendance->student->nisn }}</td>
                <td>{{ $attendance->student->name }}</td>
                <td>{{ $attendance->student->gender }}</td>
                @for ($i = 1; $i <= $daysInMonth; $i++)
                    @php
                        $date = $year . '-' . $month . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                        // Check if there's a record for this student on the specific date
                        $dailyAttendance = $attendanceRecords->where('date', $date)->first();
                    @endphp
                    <td>{{ $dailyAttendance ? $dailyAttendance->information : '' }}</td>
                @endfor
            </tr>
        @endforeach
    </tbody>
</table>


    <div class="notes">
        <p><strong>Keterangan:</strong></p>
        <p>V = Hadir, S = Sakit, I = Ijin, A = Alpha</p>
    </div>
</body>
</html>

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
            margin-bottom: 15px;
        }
        h3 {
            margin: 0;
            text-align: center;
        }
        .main {
            display: flex;
            justify-content: space-between;
        }
        .notes {
            float: right;
            margin-top: -80px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h3>SMP NEGERI 1 PONOROGO</h3>
    <div class="main">
        <div class="header">
            <p>KELAS : {{ $attendances->first()->first()->classroom->name }}</p>
            <p>Wali Kelas: {{ $attendances->first()->first()->classroom->teacher->name }}</p>
            <p>Bulan: {{ $day }} {{ $monthName }} {{ $year }} | (L): <strong>{{ $totalL }}</strong>, (P): <strong>{{ $totalP }}</strong></p>
        </div>
        <div class="notes">
            <p><strong>Keterangan:</strong></p>
            <p>V = Hadir, S = Sakit, I = Ijin, A = Alpha</p>
            <p>H: <strong>{{ $totalV }}</strong>, S: <strong>{{ $totalS }}</strong>, I: <strong>{{ $totalI }}</strong>, A: <strong>{{ $totalA }}</strong></p>
        </div>
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
</body>
</html>

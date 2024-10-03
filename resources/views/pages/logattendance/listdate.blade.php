<x-app-layout>
    <x-slot name="headerNav">
        {{ 'Kelas ' . $classroom->name }}
    </x-slot>

    <div class="container mx-auto mt-6">
        @if ($attendanceDates->isEmpty())
            <div class="alert alert-warning mt-4">
                Riwayat Daftar Hadir kosong
            </div>
        @else
            <div class="overflow-x-auto mt-6">
                <!-- Tabel untuk menampilkan tanggal absensi -->
                <table class="table w-full border border-solid">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Absensi</th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        @foreach ($attendanceDates as $index => $attendance)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>

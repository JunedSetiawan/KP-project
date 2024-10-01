<x-app-layout>
    <x-slot name="headerNav">
        {{ 'Kelas ' . $classroom->name }}
    </x-slot>
    

    <div class="container mx-auto mt-6">
        @if ($students->isEmpty())
            <div class="alert alert-warning mt-4">
                No students found for this class.
            </div>
        @else
            <div class="overflow-x-auto mt-6">
                <table class="table w-full">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Keterangan</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <!-- Form untuk mengirimkan presensi siswa -->
                                    <form method="POST" action="{{ route('attendance.mark', $student->id) }}">
                                        @csrf
                                        <!-- Radio buttons for attendance -->
                                        <div class="form-control flex flex-row">
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance_status" value="V" class="radio radio-primary" required>
                                                <span class="label-text ml-2">V</span>
                                            </label>
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance_status" value="S" class="radio radio-secondary" required>
                                                <span class="label-text ml-2">S</span>
                                            </label>
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance_status" value="I" class="radio radio-accent" required>
                                                <span class="label-text ml-2">I</span>
                                            </label>
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance_status" value="A" class="radio radio-error" required>
                                                <span class="label-text ml-2">A</span>
                                            </label>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Back to Class List button -->
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary mt-4">Back to Class List</a>
    </div>
</x-app-layout>

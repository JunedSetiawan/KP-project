<x-app-layout>
    <x-slot name="headerNav">
        {{ 'Kelas ' . $classroom->name }}
    </x-slot>

    <div class="container mx-auto mt-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold">Daftar Hadir Kelas {{ $classroom->name }} </h2>
            <p class="text-md font-semibold">{{ $date->isoFormat('dddd, MMMM YYYY')  }}</p>
            <p class="text-md font-semibold">Tahun Ajaran  {{ $students->first()->schoolYear->year }}</p>
        </div>
        @if ($students->isEmpty())
            <div class="alert alert-warning mt-4">
                No students found for this class.
            </div>
        @else
            <div class="overflow-x-auto mt-6">
                <!-- Tombol "Check All" -->
                <div class="mb-4">
                    <button type="button" id="checkAll" class="btn btn-sm btn-secondary">
                        Check All Hadir (V)
                    </button>
                </div>

                <!-- Form yang mengirim seluruh absensi sekaligus -->
                <form method="POST" action="{{ route('attendance.submitAll', $classroom->id) }}" >
                    @csrf
                    <table class="table w-full bg-white">
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
                                        <!-- Radio buttons for attendance -->
                                        <div class="form-control flex flex-row">
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance[{{ $student->id }}][status]" value="V" class="radio radio-primary" required>
                                                <span class="label-text ml-2">V</span>
                                            </label>
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance[{{ $student->id }}][status]" value="S" class="radio radio-secondary" required>
                                                <span class="label-text ml-2">S</span>
                                            </label>
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance[{{ $student->id }}][status]" value="I" class="radio radio-accent" required>
                                                <span class="label-text ml-2">I</span>
                                            </label>
                                            <label class="cursor-pointer label">
                                                <input type="radio" name="attendance[{{ $student->id }}][status]" value="A" class="radio radio-error" required>
                                                <span class="label-text ml-2">A</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Textarea for notes -->
                                        <textarea name="attendance[{{ $student->id }}][note]" class="textarea textarea-bordered w-full" placeholder="Masukkan catatan..."></textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Tombol Submit di bagian bawah tabel -->
                    <button type="submit" class="btn btn-primary mt-4">Submit Absensi</button>
                </form>
            </div>
        @endif

        <!-- Back to Class List button -->
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary mt-4">Back to Class List</a>
    </div>

    <!-- JavaScript untuk tombol Check All -->
    <x-splade-script>
        document.getElementById('checkAll').addEventListener('click', function() {
            // Ambil semua radio button yang memiliki value "V"
            const radioButtons = document.querySelectorAll('input[type="radio"][value="V"]');
            console.log(radioButtons);
            // Set semua radio button yang memiliki value "V" menjadi checked
            radioButtons.forEach(function(radio) {
                radio.checked = true;
            });
        });
    </x-splade-script>

</x-app-layout>

<script>
</script>

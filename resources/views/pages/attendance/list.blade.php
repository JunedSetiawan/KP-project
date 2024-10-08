<x-app-layout>
    <x-slot name="headerNav">
        {{ 'Daftar Hadir Kelas ' . $classroom->name }}
    </x-slot>

    <div class="container mx-auto mt-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold">Daftar Hadir Kelas {{ $classroom->name }} </h2>
            <p class="text-md font-semibold">{{ $date->isoFormat('dddd, DD MMMM YYYY')  }}</p>
            <p class="text-md font-semibold">Tahun Ajaran  {{ $students->first()->schoolYear->year }}</p>
        </div>
        @if ($students->isEmpty())
            <div class="alert alert-warning mt-4">
                Tidak ada siswa dalam kelas ini.
            </div>
        @else
            <div class="overflow-x-auto mt-6">
                <!-- Tombol "Check All" -->
                <div class="mb-4">
                    <button type="button" id="checkAll" class="btn btn-sm btn-secondary">
                        Checked Semua Hadir (V)
                    </button>
                </div>

                <!-- Form yang mengirim seluruh absensi sekaligus -->
                <form id="attendanceForm" method="POST" action="{{ route('attendance.submitAll', $classroom->id) }}" >
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

                    <!-- Tombol Submit yang membuka modal -->
                    <button type="button" id="openConfirmModal" class="btn btn-primary mt-4">Simpan Absensi</button>
                </form>
            </div>
        @endif

        <!-- Back to Class List button -->
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary mt-4">Kembali</a>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 class="text-lg font-bold mb-4">Konfirmasi</h3>
            <p>Apakah Anda yakin ingin menyimpan absensi ini?</p>
            <div class="mt-6 flex justify-end">
                <button id="cancelButton" class="btn btn-secondary mr-2">Batal</button>
                <button id="confirmButton" class="btn btn-primary">Ya, Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Error Absensi Belum Diisi -->
@if (session('error'))
<div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h3 class="text-lg font-bold mb-4">Kesalahan</h3>
        <p>{{ session('error') }}</p>
        <div class="mt-6 flex justify-end">
            <button id="closeErrorModal" class="btn btn-secondary">Tutup</button>
        </div>
    </div>
</div>
@endif

    <!-- JavaScript untuk Check All dan Modal Konfirmasi -->
    <x-splade-script>
        document.getElementById('checkAll').addEventListener('click', function() {
            // Ambil semua radio button yang memiliki value "V"
            const radioButtons = document.querySelectorAll('input[type="radio"][value="V"]');
            // Set semua radio button yang memiliki value "V" menjadi checked
            radioButtons.forEach(function(radio) {
                radio.checked = true;
            });
        });

        // Buka modal saat tombol "Simpan Absensi" diklik
        document.getElementById('openConfirmModal').addEventListener('click', function() {
            document.getElementById('confirmModal').classList.remove('hidden');
        });

        // Tutup modal jika tombol "Batal" diklik
        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('confirmModal').classList.add('hidden');
        });

        // Submit form saat tombol "Ya, Simpan" diklik
        document.getElementById('confirmButton').addEventListener('click', function() {
            document.getElementById('attendanceForm').submit();
        });

        // Modal error jika data belum diisi
        document.getElementById('closeErrorModal')?.addEventListener('click', function() {
            document.getElementById('errorModal').classList.add('hidden');
        });
    </x-splade-script>

</x-app-layout>

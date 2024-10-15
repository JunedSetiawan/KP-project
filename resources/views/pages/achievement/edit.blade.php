<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit Prestasi') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$achievement"
            action="{{ route('achievement.update', $achievement->id) }}" method="put">
            @csrf

            <!-- Select Kelas -->
            <input type="text" name="classroom" label="Kelas" disabled readonly value="{{ $classroom }}" />

            <!-- Select Siswa -->
            <input type="text" name="student_id" label="Pilih Siswa" value="{{ $students->name }}" disabled readonly />

            <!-- Input Prestasi -->
            <x-splade-input name="achievement" label="Prestasi" required />

            <!-- Input Keterangan -->
            <x-splade-input name="note" label="Keterangan" required />

            <!-- File Upload -->
            <x-splade-file name="image" filepond preview accept="image/png,image/jpg,image/jpeg"
                label="Bukti Prestasi" />

            <!-- Menampilkan gambar bukti yang sudah ada -->
            <div>
                <label>Bukti Prestasi Sebelumnya:</label>
                <img src="{{ route('getImage', ['filename' => $achievement->image]) }}"
                    alt="{{ $achievement->image }}" class="w-32 h-32 object-cover mt-2" />
            </div>
            
            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>

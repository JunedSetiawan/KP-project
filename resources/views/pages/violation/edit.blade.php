<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit Violations') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$violation"
            action="{{ route('violation.update', $violation->id) }}" method="put">
            @csrf
            <x-splade-select name="classroom" label="Pilih Kelas" placeholder="-- Pilih Kelas --" :options="$classrooms" />
            <x-splade-select name="student_id" remote-url="`/load/student/${form.classroom}`" select-first-remote-option label="Pilih Siswa" placeholder="-- Siswa --" option-label="name" option-value="id" />
            <x-splade-input name="violation" label="Pelanggaran" required />
            <x-splade-input name="note" label="Keterangan" required />
            <x-splade-file name="evidence" filepond preview accept="image/png,image/jpg,image/jpeg" label="Bukti Sanksi" />
            {{-- <x-splade-input name="wali_kelas" label="Wali Kelas" required /> --}}

            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>

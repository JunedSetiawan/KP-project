<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Create Violations') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-2 p-5" action="{{ route('violation.store') }}" method="post">
        @csrf
        <x-splade-select name="classroom" label="Pilih Kelas" placeholder="-- Pilih Kelas --" :options="$classrooms" />
        <x-splade-select name="student_id" remote-url="`/load/student/${form.classroom}`" select-first-remote-option label="Pilih Siswa" placeholder="-- Siswa --" option-label="name" option-value="id" />
        <x-splade-input name="violation" label="Pelanggaran" required />
        <x-splade-input name="note" label="Keterangan" required />
        <x-splade-file name="evidence" filepond preview accept="image/png,image/jpg,image/jpeg" label="Bukti Sanksi" />
        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
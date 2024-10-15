<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Buat Prestasi') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-2 p-5" action="{{ route('achievement.store') }}" method="post">
        @csrf
        <x-splade-select name="classroom" label="Pilih Kelas" placeholder="-- Pilih Kelas --" :options="$classrooms" />
        <x-splade-select name="student_id" remote-url="`/load/student/${form.classroom}`" select-first-remote-option label="Pilih Siswa" placeholder="-- Siswa --" option-label="name" option-value="id" />
        <x-splade-input name="achievement" label="Prestasi" required />
        <x-splade-input name="note" label="Keterangan" required />
        <x-splade-file name="image" filepond preview accept="image/png,image/jpg,image/jpeg" label="Bukti Prestasi" />
        <x-splade-input name="point" label="Poin" required />
        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
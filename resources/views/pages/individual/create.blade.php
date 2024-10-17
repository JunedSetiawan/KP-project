<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Membuat data Materi') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-2 p-5" action="{{ route('material.store') }}" method="post">
        @csrf
        <x-splade-input name="name" label="Nama materi" required />
        <x-splade-select name="semester_id" :options="$semesters" label="Pilih Semester" required placeholder="Pilih kelas" />
        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
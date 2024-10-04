<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Membuat data kelas') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-2 p-5" action="{{ route('classes.store') }}" method="post">
        @csrf
     
        <x-splade-select name="classroom" :options="$classrooms" label="Kelas"  placeholder="Pilih Kelas" />
        <x-splade-select name="type" :options="$types" label="Tipe Kelas"  placeholder="Pilih Tipe Kelas" />

        <x-splade-select name="teacher_id" :options="$teacher->pluck('name', 'id')" label="Pilih Wali Kelas" placeholder="Pilih Wali Kelas" />

        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
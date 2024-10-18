<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Buat Detail Materi') }}
    </x-slot>

    <x-splade-form :default="['material_id' => $material_id]" class="bg-base-100 space-y-2 p-5" action="{{ route('detailmaterial.store') }}" method="post">
        @csrf
        <x-splade-input name="content" label="Deskripsi Materi" type="text"/>
        <x-splade-input name="url_video" label="URL Video Materi" type="text"/>
        <x-splade-file name="file" label="File Materi PDF"/>
        {{-- <x-splade-input name="wali_kelas" label="Wali_kelas" required /> --}}
        {{-- <x-splade-select name="role" :options="$roles" label="Role" required placeholder="Select 1 role" /> --}}

        <x-splade-submit label="Save" />

    </x-splade-form>

</x-app-layout>
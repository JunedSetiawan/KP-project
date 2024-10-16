<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit data materi') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$material" action="{{ route('material.update', $material->id) }}"
            method="put">
            @csrf
            <x-splade-input name="name" label="Nama Materi" />
            <x-splade-select name="semester_id" :options="$semesters" label="Pilih semester" placeholder="Pilih Wali Kelas" />

            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
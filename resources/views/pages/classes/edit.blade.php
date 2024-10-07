<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit data siswa') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$classes" action="{{ route('classes.update', $classes->id) }}"
            method="put">
            @csrf
            <x-splade-input name="name" label="Nama" />
            <x-splade-select name="teacher_id" :options="$teacher" label="Pilih Wali Kelas" placeholder="Pilih Wali Kelas" option-label="name" option-value="id" />

            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
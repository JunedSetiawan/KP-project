<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit data materi') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$classroom" action="{{ route('individual.service.store') }}"
            method="post">
            @csrf
            <x-splade-input name="name" label="kelas" disabled/>
            <x-splade-select name="teacher_id" :options="$teacher" label="Pilih Guru Penanggung Jawab" placeholder="Pilih Guru Penanggung Jawab" option-label="name" option-value="id" />

            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
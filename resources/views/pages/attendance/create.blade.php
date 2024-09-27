<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Create Student') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-4 p-5" action="{{ route('student.store') }}" method="post">
        @csrf
        <x-splade-input name="name" label="Nama" required />
        <x-splade-group name="information" label="Pilih Jenis Kelamin" inline>
            <x-splade-radio name="information" value="Hadir" label="Hadir" />
            <x-splade-radio name="information" value="Sakit" label="Sakit" />
            <x-splade-radio name="information" value="Ijin" label="Ijin" />
            <x-splade-radio name="information" value="Alasan" label="Alasan" />
        </x-splade-group>
        <x-splade-select name="class_id" :options="$classes->pluck('name', 'id')" label="Pilih Kelas" required placeholder="Pilih kelas" />

        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
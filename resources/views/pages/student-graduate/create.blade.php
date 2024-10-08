<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Membuat data siswa') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-4 p-5" action="{{ route('student.store') }}" method="post">
        @csrf
        <x-splade-input name="nipd" label="NIPD"/>
        <x-splade-input name="nisn" label="NISN"/>
        <x-splade-input name="name" label="Nama" required />
        <x-splade-group name="gender" label="Pilih Jenis Kelamin" inline>
            <x-splade-radio name="gender" value="L" label="Laki Laki" />
            <x-splade-radio name="gender" value="P" label="Perempuan" />
        </x-splade-group>
        <x-splade-input name="phone_number" label="Nomor HP" />
        <x-splade-select name="class_id" :options="$classrooms" label="Pilih Kelas" required placeholder="Pilih kelas" />
        <br>
        <h2 class="text-xl font-bold tracking-wide">Data Orang Tua</h2>
        <x-splade-input name="name_parent" label="Nama Orang Tua" />
        <x-splade-input name="phone_number_parent" label="Nomor Orang Tua" />
        <x-splade-input name="phone_number_parent_opt" label="Nomor Orang Tua Wali(Opsional)"/>
        {{-- <x-splade-select name="role" :options="$roles" label="Role" required placeholder="Select 1 role" /> --}}

        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
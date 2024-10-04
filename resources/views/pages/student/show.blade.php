<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Detail Siswa') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$student"
            >
     
            <x-splade-input name="nipd" label="NIPD" disabled />
            <x-splade-input name="nisn" label="NISN" disabled />
            <x-splade-input name="name" label="Nama" disabled />
            <x-splade-input name="gender" label="Jenis Kelamin" disabled />
          
            <x-splade-input name="phone_number" label="Nomor HP" disabled />
            <x-splade-input name="classroom.name" label="Kelas" disabled />

            <br>
            <h2 class="text-xl font-bold tracking-wide">Data Orang Tua</h2>
            <x-splade-input name="name_parent" label="Nama Orang Tua" disabled />
            <x-splade-input name="phone_number_parent" label="Nomor Orang Tua" disabled />
            <x-splade-input name="phone_number_parent_opt" label="Nomor Orang Tua Wali(Opsional)" disabled />

           
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>

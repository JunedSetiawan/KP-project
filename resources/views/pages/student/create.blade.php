<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Create Student') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-4 p-5" action="{{ route('student.store') }}" method="post">
        @csrf
        <x-splade-input name="nis" label="NIS" required />
        <x-splade-input name="name" label="Nama" required />
        <x-splade-group name="gender" label="Pilih Jenis Kelamin" inline>
            <x-splade-radio name="gender" value="L" label="Laki Laki" />
            <x-splade-radio name="gender" value="P" label="Perempuan" />
        </x-splade-group>
        <x-splade-input name="phone_number" label="Nomor HP" required />
        <x-splade-select name="class_id" :options="$classes->pluck('name', 'id')" label="Pilih Kelas" required placeholder="Pilih kelas" />
        <br>
        <h2 class="text-xl font-bold tracking-wide">Data Orang Tua</h2>
        <x-splade-input name="name_parent" label="Nama Orang Tua" required />
        <x-splade-input name="phone_number_parent" label="Nomor Orang Tua" required />
        <x-splade-input name="phone_number_parent_opt" label="Nomor Orang Tua Wali(Opsional)"/>
        {{-- <x-splade-select name="role" :options="$roles" label="Role" required placeholder="Select 1 role" /> --}}

        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
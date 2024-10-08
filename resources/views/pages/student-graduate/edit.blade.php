<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit data alumni') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$student"
            action="{{ route('studentgraduate.update', $student->id) }}" method="put">
            @csrf
            <x-splade-input name="nipd" label="NIPD" />
            <x-splade-input name="nisn" label="NISN" />
            <x-splade-input name="name" label="Nama"  />
            <x-splade-group name="gender" label="Pilih Jenis Kelamin" inline>
                <x-splade-radio name="gender" value="L" label="Laki Laki" />
                <x-splade-radio name="gender" value="P" label="Perempuan" />
            </x-splade-group>
            <x-splade-input name="phone_number" label="Nomor HP" />
            <x-splade-select  name="classroom_id" :options="$classrooms" label="Pilih Kelas"  placeholder="Pilih kelas" />
            <br>
            <h2 class="text-xl font-bold tracking-wide">Data Orang Tua</h2>
            <x-splade-input name="name_parent" label="Nama Orang Tua" />
            <x-splade-input name="phone_number_parent" label="Nomor Orang Tua" />
            <x-splade-input name="phone_number_parent_opt" label="Nomor Orang Tua Wali(Opsional)" />
            <x-splade-input name="note" label="Keterangan" />
            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>

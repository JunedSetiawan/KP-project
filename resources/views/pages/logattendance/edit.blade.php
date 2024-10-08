<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit data kehadiran siswa') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$logattendances" 
    action="{{ route('logattendance.update', ['logattendance' => $logattendances->id]) }}" method="put">

            @csrf
            <!-- Display the student's name in a disabled input -->
            <x-splade-input name="student_name" :placeholder="$studentName" label="Nama Siswa" :value="$studentName" disabled />

            <x-splade-group name="information" label="Pilih Keterangan" inline>
                <x-splade-radio name="information" value="V" label="V" />
                <x-splade-radio name="information" value="S" label="S" />
                <x-splade-radio name="information" value="I" label="I" />
                <x-splade-radio name="information" value="A" label="A" />
            </x-splade-group>

            <x-splade-input name="note" label="Note" />

            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
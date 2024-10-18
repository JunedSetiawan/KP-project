<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Create Teachers') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-2 p-5" action="{{ route('teacher.store') }}" method="post">
        @csrf
        <x-splade-input name="nip" label="Nip" required />
        <x-splade-input name="name" label="Name" required />
        <x-splade-group name="type" label="Pilih tipe guru" inline>
            <x-splade-radio name="type" value="Umum" label="Umum" />
            <x-splade-radio name="type" value="BK" label="BK" />
        </x-splade-group>

        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
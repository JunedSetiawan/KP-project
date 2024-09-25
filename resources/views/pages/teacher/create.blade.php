<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Create Teachers') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-2 p-5" action="{{ route('teacher.store') }}" method="post">
        @csrf
        <x-splade-input name="nip" label="Nip" required />
        <x-splade-input name="name" label="Name" required />
        <x-splade-input name="wali_kelas" label="Wali_kelas" required />
        {{-- <x-splade-select name="role" :options="$roles" label="Role" required placeholder="Select 1 role" /> --}}

        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Create Student') }}
    </x-slot>


    <x-splade-form class="bg-base-100 space-y-4 p-5" action="{{ route('schoolyear.store') }}" method="post">
        @csrf
        <x-splade-input name="start_year" label="Tahun Mulai" required />
        <x-splade-input name="end_year" label="Tahun Selesai" required />
        {{-- <x-splade-select name="role" :options="$roles" label="Role" required placeholder="Select 1 role" /> --}}

        <x-splade-submit label="Save" />

    </x-splade-form>
</x-app-layout>
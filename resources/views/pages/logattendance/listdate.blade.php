<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Riwayat Daftar Hadir Per Tanggal') }}
    </x-slot>

    {{-- @can('manage-user') --}}
    <div class="flex justify-between">

</div>
    {{-- @endcan --}}
    <x-splade-table :for="$logattendances">
        {{-- @can('manage-user') --}}
            <x-splade-cell Actions as="$logattendance">
            </x-splade-cell>
            
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>

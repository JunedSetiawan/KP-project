<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Riwayat Daftar Hadir') }}
    </x-slot>

    {{-- @can('manage-user') --}}
    <div class="flex justify-between">

</div>
    {{-- @endcan --}}
    <x-splade-table :for="$logattendances">
        {{-- @can('manage-user') --}}
            <x-splade-cell Actions as="$logattendance">
                <div class="space-x-3">
                    <Link slideover href="{{ route('logattendance.edit', $logattendance->id) }}" class="btn btn-secondary">Edit</Link>
                    <Link confirm href="{{ route('logattendance.destroy', $logattendance->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
            
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>
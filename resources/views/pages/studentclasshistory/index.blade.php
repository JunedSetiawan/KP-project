<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Riwayat Data Kelas') }}
    </x-slot>
    {{-- @endcan --}}
    <x-splade-table :for="$studentclasshistorys">
        {{-- @can('manage-user') --}}
            <x-splade-cell Actions as="$studentclasshistory">
                <div class="space-x-3">
                    <Link slideover href="{{ route('studentclasshistory.edit', $studentclasshistory->id) }}" class="btn btn-secondary">Edit</Link>
                    <Link confirm href="{{ route('studentclasshistory.destroy', $studentclasshistory->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
            
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>
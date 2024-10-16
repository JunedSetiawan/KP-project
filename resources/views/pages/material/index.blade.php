<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Materi') }}
    </x-slot>

    {{-- @can('manage-classes') --}}
    <div class="flex justify-between">
    <Link href="{{ route('material.create') }}" class="btn btn-secondary">Create</Link>
</div>
    {{-- @endcan --}}
    <x-splade-table :for="$materials">
        {{-- @can('manage-classes') --}}
            <x-splade-cell actions as="$material">
                <div class="space-x-3">
                    <Link slideover href="{{ route('material.edit', $material->id) }}" class="btn btn-secondary">Edit</Link>
                    <Link confirm href="{{ route('material.destroy', $material->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>

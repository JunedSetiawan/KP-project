<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Pelanggaran') }}
    </x-slot>

    <div class="flex justify-between">
        <Link href="{{ route('teacher.create') }}" class="btn btn-secondary mb-4">Create</Link>
    </div>

    <x-splade-table :for="$violations">
        <x-splade-cell actions as="$violation">
            <div class="space-x-3">
                <Link slideover href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-secondary">Edit</Link>
                <Link confirm href="{{ route('teacher.destroy', $teacher->id) }}" class="btn btn-error" method="DELETE">Delete</Link>
            </div>
        </x-splade-cell>
        <x-slot name="empty-state">
            <p>Data is empty!</p>
        </x-slot>
    </x-splade-table>
</x-app-layout>

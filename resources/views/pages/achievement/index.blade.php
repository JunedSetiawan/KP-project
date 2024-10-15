<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Prestasi') }}
    </x-slot>

    <div class="flex justify-between">
        <Link href="{{ route('achievement.create') }}" class="btn btn-secondary mb-4">Create</Link>
    </div>

    <x-splade-table :for="$achievements">
        <x-splade-cell actions as="$achievement">
            <div class="space-x-3">
                <Link slideover href="{{ route('achievement.edit', $achievement->id) }}" class="btn btn-secondary">Edit</Link>
                <Link confirm href="{{ route('achievement.destroy', $achievement->id) }}" class="btn btn-error" method="DELETE">Delete</Link>
            </div>
        </x-splade-cell>
        <x-slot name="empty-state">
            <p>Data is empty!</p>
        </x-slot>
    </x-splade-table>
</x-app-layout>

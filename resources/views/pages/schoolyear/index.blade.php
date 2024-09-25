<x-app-layout>
    <x-slot name="headerNav">
        {{ __('School Years') }}
    </x-slot>

    {{-- @can('manage-user') --}}
    <div class="flex justify-between">
    <Link href="{{ route('schoolyear.create') }}" class="btn btn-secondary mb-4">Create</Link>
</div>
    {{-- @endcan --}}
    <x-splade-table :for="$schoolyears">
        {{-- @can('manage-user') --}}
            <x-splade-cell Actions as="$schoolyear">
                <div class="space-x-3">
                    <Link slideover href="{{ route('schoolyear.edit', $schoolyear->id) }}" class="btn btn-secondary">Edit</Link>
                    <Link confirm href="{{ route('schoolyear.destroy', $schoolyear->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
            <x-slot:empty-state>
                <p>Data is empty!</p>
            </x-slot>
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>
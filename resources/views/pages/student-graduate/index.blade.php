<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Siswa Lulus') }}
    </x-slot>


    {{-- @endcan --}}
    <x-splade-table :for="$students" search-debounce="700">
        {{-- @can('manage-user') --}}
        <x-splade-cell Actions as="$student">
            <div class="space-x-3">
                <Link slideover href="{{ route('studentgraduate.edit', $student->id) }}" class="btn btn-secondary">Edit</Link>
            </div>
        </x-splade-cell>

        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>

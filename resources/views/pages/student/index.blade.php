<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Students') }}
    </x-slot>

    {{-- @can('manage-user') --}}
    <div class="flex justify-between">
    <Link href="{{ route('student.create') }}" class="btn btn-secondary mb-4">Create</Link>
    <x-splade-form action="{{ route('student.import') }}"
    >
    @csrf
    <label for="">Import Data Siswa (excel/xlsx)</label>
    <div class="flex items-center mb-4">
        <input class="file-input file-input-bordered w-full max-w-xs" type="file" dusk="import" @input="form.import = $event.target.files[0]" />
        <button type="submit" class="btn btn-primary ml-2">Import</button>
    </div>
    <p v-text="form.errors.import" />
    </x-splade-form>
</div>
    {{-- @endcan --}}
    <x-splade-table :for="$students" search-debounce="700">
        {{-- @can('manage-user') --}}
            <x-splade-cell Actions as="$student">
                <div class="space-x-3">
                    <Link slideover href="{{ route('student.edit', $student->id) }}" class="btn btn-secondary">Edit</Link>
                    <Link confirm href="{{ route('student.destroy', $student->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
            
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>
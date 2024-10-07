<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Siswa') }}
    </x-slot>

    {{-- @can('manage-user') --}}
    <div class="flex justify-between">
        <Link href="{{ route('student.create') }}" class="btn btn-secondary mb-4">Create</Link>
        <x-splade-form action="{{ route('student.import') }}">
            @csrf
            <label for="">Import Data Siswa (excel/xlsx)</label>
            <div class="flex items-center mb-4">
                <input class="file-input file-input-bordered w-full max-w-xs" type="file" dusk="import"
                    @input="form.import = $event.target.files[0]" />
                <button type="submit" class="btn btn-primary ml-2">Import</button>
            </div>
            <p v-text="form.errors.import" />
        </x-splade-form>
    </div>

    <div class="p-5 bg-white mb-5 flex justify-around items-center"
        style="border-radius: 3%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div>
            <h2 class="text-xl font-bold">
                Cara transfer siswa naik kelas berikutnya
            </h2>
            <ul class="font-semibold text-lg">
                <li> - tes</li>
            </ul>
        </div>
        <div class="divider lg:divider-horizontal"></div> 
        <div>
            <h2 class="text-xl font-bold">
                Cara transfer Kelulusan siswa dan statusnya
            </h2>
            <ul class="font-semibold text-lg">
                <li> - tes</li>
            </ul>
        </div>
    </div>
    {{-- @endcan --}}
    <x-splade-table :for="$students" search-debounce="700">
        {{-- @can('manage-user') --}}
        <x-splade-cell Actions as="$student">
            <div class="space-x-3">
                <Link slideover href="{{ route('student.edit', $student->id) }}" class="btn btn-secondary">Edit</Link>
                <Link confirm href="{{ route('student.destroy', $student->id) }}" class="btn btn-error" method="DELETE">
                Delete
                </Link>
            </div>
        </x-splade-cell>

        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>

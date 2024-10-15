<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Guru') }}
    </x-slot>

    <div class="flex justify-between">
        <Link href="{{ route('teacher.create') }}" class="btn btn-secondary mb-4">Create</Link>

        <x-splade-form action="{{ route('teacher.import') }}" class="mb-4">
            @csrf
            <label for="">Import Data Guru (excel/xlsx)</label>
            <div class="flex items-center">
                <input class="file-input file-input-bordered w-full max-w-xs" type="file" dusk="import" @input="form.import = $event.target.files[0]" />
                <button type="submit" class="btn btn-primary ml-2">Submit</button>
            </div>
            <p v-text="form.errors.import" />
        </x-splade-form>
    </div>

    <x-splade-table :for="$teachers">
        <x-splade-cell actions as="$teacher">
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

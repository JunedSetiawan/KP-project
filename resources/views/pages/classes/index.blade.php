<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Classroom') }}
    </x-slot>

    {{-- @can('manage-classes') --}}
    <div class="flex justify-between">
    <Link href="{{ route('classes.create') }}" class="btn btn-secondary mb-4">Create</Link>
    <x-splade-form action="{{ route('classes.import') }}"
    >
    @csrf
    <div class="flex items-center">
        <input class="file-input file-input-bordered w-full max-w-xs" type="file" dusk="import" @input="form.import = $event.target.files[0]" />
        <button type="submit" class="btn btn-primary ml-2">Submit</button>
    </div>
    <p v-text="form.errors.import" />
    </x-splade-form>
</div>
    {{-- @endcan --}}
    <x-splade-table :for="$classrooms">
        {{-- @can('manage-classes') --}}
            <x-splade-cell actions as="$classroom">
                <div class="space-x-3">
                    <Link slideover href="{{ route('classes.edit', $classroom->id) }}" class="btn btn-secondary">Edit</Link>
                    <Link confirm href="{{ route('classes.destroy', $classroom->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
            <x-slot:empty-state>
                <p>Data is empty!</p>
            </x-slot>
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>
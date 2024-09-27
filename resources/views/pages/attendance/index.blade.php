<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Attendance') }}
    </x-slot>

    {{-- @can('manage-user') --}}
    <div class="flex justify-between">

</div>
    {{-- @endcan --}}
    <x-splade-table :for="$attendances">
        {{-- @can('manage-user') --}}
            <x-splade-cell Actions as="$attendance">
                <div class="space-x-3">
                    <Link slideover href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-secondary">Edit</Link>
                    <Link confirm href="{{ route('attendance.destroy', $attendance->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
            
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>
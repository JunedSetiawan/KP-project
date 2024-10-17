<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Layanan Individual') }}
    </x-slot>

    {{-- @can('manage-classes') --}}
    {{-- @endcan --}}
    <x-splade-table :for="$individuals">
        @can('manage-student')
            <x-splade-cell actions as="$individual">
                <div class="space-x-3">
                    <Link slideover href="{{ route('individual.service.edit', $individual->id) }}" class="btn btn-secondary">Kaitkan</Link>
                
                </div>
            </x-splade-cell>
        @endcan
    </x-splade-table>
</x-app-layout>

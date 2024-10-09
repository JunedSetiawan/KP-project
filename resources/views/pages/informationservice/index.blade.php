<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Layanan Informasi') }}
    </x-slot>

    {{-- @can('manage-classes') --}}
    <div class="flex justify-between">
</div>
    {{-- @endcan --}}
    <x-splade-table :for="$informationservices">
        {{-- @can('manage-classes') --}}
            <x-splade-cell actions as="$informationservice">
                <div class="space-x-3">
                    <Link confirm href="{{ route('classes.destroy', $classroom->id) }}" class="btn btn-error" method="DELETE">Delete
                    </Link>
                </div>
            </x-splade-cell>
        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>

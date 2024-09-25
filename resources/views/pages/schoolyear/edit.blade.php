<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit School Year') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$schoolyear" action="{{ route('schoolyear.update', $schoolyear->id) }}"
            method="put">
            @csrf
            <x-splade-input name="start_year" label="Tahun Mulai"  required />
            <x-splade-input name="end_year" label="Tahun Selesai" required />
            <x-splade-input name="status" label="Status" required />

            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Edit Teachers') }}
    </x-slot>

    <x-splade-modal>
        <x-splade-form class="bg-base-100 space-y-2 p-5" :default="$teacher"
            action="{{ route('teacher.update', $teacher->id) }}" method="put">
            @csrf
            <x-splade-input name="nip" label="Nip" required />
            <x-splade-input name="name" label="Name" required />
            {{-- <x-splade-input name="wali_kelas" label="Wali Kelas" required /> --}}

            <div class="flex justify-between">
                <x-splade-submit />
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>

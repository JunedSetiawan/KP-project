<!-- resources/views/pages/attendance/list.blade.php -->

<x-splade-table :for="$students">
    <x-splade-cell name as="$student">
        {{ $student->name }}
    </x-splade-cell>

    <x-splade-cell nis as="$student">
        {{ $student->nis }}
    </x-splade-cell>

    <x-splade-cell gender as="$student">
        {{ $student->gender }}
    </x-splade-cell>
</x-splade-table>

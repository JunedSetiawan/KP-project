<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Daftar Hadir') }}
    </x-slot>

    <div class="flex justify-between">
        @php
            $firstDate = $logattendances->date;
            $month = \Carbon\Carbon::parse($firstDate)->format('m');
            $year = \Carbon\Carbon::parse($firstDate)->format('Y');
        @endphp

        <a href="{{ route('logattendance.exportPdf', ['month' => $month, 'year' => $year, 'classrooms_id' => $classroom->id]) }}"
           class="btn btn-secondary mb-4 pdf-export-link">Export PDF</a>
    </div>

    <x-splade-table :for="$logattendances">
        <!-- Information column -->
        <x-splade-cell information as="$logattendance">
            {{ $logattendance->getFullInformation() }}
        </x-splade-cell>

        <!-- New Actions column for the Edit link -->
        <x-splade-cell actions as="$logattendance">
            <div class="space-x-3">
                <Link slideover href="{{ route('logattendance.edit', $logattendance->id) }}" class="btn btn-secondary">Edit</Link>
            </div>
        </x-splade-cell>
    </x-splade-table>

</x-app-layout>



<x-splade-script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.pdf-export-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = this.href;
            });
        });
    });
</x-splade-script>

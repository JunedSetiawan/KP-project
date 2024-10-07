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

        <a href="{{ route('logattendance.exportPdf', ['month' => $month, 'year' => $year]) }}" 
           class="btn btn-secondary mb-4 pdf-export-link">Export PDF</a>
    </div>

    <x-splade-table :for="$logattendances">
        <x-splade-cell information as="$logattendance">
            {{ $logattendance->getFullInformation() }} <!-- Use the new method to get full info -->
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

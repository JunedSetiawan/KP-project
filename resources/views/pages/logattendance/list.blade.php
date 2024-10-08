<x-app-layout>
    <x-slot name="headerNav">
        {{ 'Daftar Hadir Kelas ' . $classroom->name }}
    </x-slot>

    <div class="container mx-auto mt-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold">Daftar Hadir Kelas {{ $classroom->name }} </h2>
            <p class="text-md font-semibold">{{ \Carbon\Carbon::parse($date)->isoFormat('dddd, DD MMMM YYYY') }}</p>
            <p class="text-md font-semibold">Tahun Ajaran  {{ $students->first()->schoolYear->year }}</p>
        </div>

        <!-- Tabel Kehadiran -->
        <x-splade-table :for="$logattendances">
            <x-splade-cell information as="$logattendance">
                {{ $logattendance->getFullInformation() }} <!-- Use the new method to get full info -->
            </x-splade-cell>
        </x-splade-table>
    </div>
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

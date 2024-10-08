<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Riwayat Daftar Hadir Per Tanggal') }}
    </x-slot>

    {{-- @can('manage-user') --}}
    <div class="flex justify-between">
<form id="exportForm" action="{{ route('logattendance.exportPdf', ['classrooms_id' => $classroom->id]) }}" method="GET">
            @csrf
            <div class="flex justify-center gap-4 mt-4">
                <!-- Dropdown for Month -->
                <select required name="month" id="monthDropdown" class="select select-bordered">
                    <option value="" disabled selected>Pilih Bulan</option>
                    @foreach (range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                    @endforeach
                </select>

                <!-- Dropdown for Year -->
                <select required name="year" id="yearDropdown" class="select select-bordered">
                    <option value="" disabled selected>Pilih Tahun</option>
                    @foreach (range(date('Y') - 5, date('Y')) as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endforeach
                </select>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-secondary">Export PDF</button>
            </div>
        </form>
</div>
@if (session('error'))
<div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h3 class="text-lg font-bold mb-4">Kesalahan</h3>
        <p>{{ session('error') }}</p>
        <div class="mt-6 flex justify-end">
            <button id="closeErrorModal" class="btn btn-secondary">Tutup</button>
        </div>
    </div>
</div>
@endif
    {{-- @endcan --}}
    <x-splade-table :for="$logattendances">
        {{-- @can('manage-user') --}}
            <x-splade-cell Actions as="$logattendance">
            </x-splade-cell>

        {{-- @endcan --}}
    </x-splade-table>
</x-app-layout>
<x-splade-script>
    // Modal error jika data belum diisi
        document.getElementById('closeErrorModal')?.addEventListener('click', function() {
            document.getElementById('errorModal').classList.add('hidden');
        });
</x-splade-script>

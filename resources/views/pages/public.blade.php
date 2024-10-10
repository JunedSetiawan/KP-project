<x-splade-form method="POST" action="{{ route('informationservice.store') }}">
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 relative">

                <img class="absolute top-0 left-0 h-20 w-auto m-4" src="https://www.svgrepo.com/show/301692/login.svg" alt="Login Icon">
                <img class="absolute top-0 right-0 h-20 w-auto m-4" src="{{ asset('img/auth/logo.png') }}" alt="Logo SMP">

                <h2 class="text-center text-3xl leading-9 font-extrabold text-gray-900 mt-12">
                    Layanan Informasi
                </h2>
                
                <!-- Dropdown untuk Pilih Guru BK -->
                <div class="mt-8">
                    <x-splade-select name="teacher" label="Pilih Guru BK" placeholder="-- Pilih Guru BK --" :options="$teachers" />
                </div>

                <!-- Dropdown untuk Pilih Kelas -->
                <div class="mt-6">
                    <x-splade-select name="kelas" label="Pilih Kelas" placeholder="-- Pilih Kelas --" :options="$classrooms" />
                </div>

                <div class="mt-6">
                    <x-splade-select name="kelas" label="Pilih Kelas" placeholder="-- Pilih Kelas --" :options="$classrooms" />
                </div>

                <!-- Textarea untuk Keterangan -->
                <div class="mt-6">
                    <x-splade-textarea name="keterangan" label="Keterangan" placeholder="Isi keterangan..." />
                </div>

                <!-- Input untuk Tanggal -->
                <div class="mt-6">
                    <x-splade-input name="tanggal" type="date" label="Tanggal" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <x-splade-submit label="Kirim" />
                </div>
                @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md">
        {{ session('success') }}
    </div>
@endif


            </div>
        </div>
    </div>
</x-splade-form>

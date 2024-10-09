<x-splade-form method="POST" action="#">
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-10 w-auto" src="https://www.svgrepo.com/show/301692/login.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                Layanan Informasi
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">

                <!-- Dropdown untuk Pilih Guru BK -->
                <div>
                    <x-splade-select name="teacher" label="Pilih Guru BK" placeholder="-- Pilih Guru BK --" :options="$teachers" />
                </div>

                <!-- Dropdown untuk Pilih Kelas -->
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

            </div>
        </div>
    </div>
</x-splade-form>

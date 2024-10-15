
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8" style="background-image: url({{ asset('img/auth/light_grey_dots_background.jpg') }});">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 relative">
            
            <img class="absolute top-0 left-0 h-20 w-auto m-4" src="https://www.svgrepo.com/show/301692/login.svg" alt="Login Icon">
            <img class="absolute top-0 right-0 h-20 w-auto m-4" src="{{ asset('img/auth/logo.png') }}" alt="Logo SMP">
            
            <h2 class="text-center text-3xl leading-9 font-extrabold text-gray-900 mt-12">
                Layanan Informasi
            </h2>
            
            <!-- Dropdown untuk Pilih Guru BK -->
            <x-splade-form method="POST" action="{{ route('informationservice.store') }}" reset-on-success>
                @csrf
                <div class="mt-8">
                    <x-splade-select name="teacher" label="Pilih Guru BK" placeholder="-- Pilih Guru BK --" :options="$teachers" />
                </div>

                <!-- Dropdown untuk Pilih Kelas -->
                <div class="mt-6">
                    <x-splade-select name="classroom" label="Pilih Kelas" placeholder="-- Pilih Kelas --" :options="$classrooms" />
                </div>

                <div class="mt-6">
                    <x-splade-select name="student" remote-url="`/load/student/${form.classroom}`" select-first-remote-option label="Pilih Siswa" placeholder="-- Siswa --" option-label="name" option-value="id" />
                </div>

                <!-- Textarea untuk Keterangan -->
                <div class="mt-6">
                    <x-splade-textarea name="keterangan" label="Keterangan" placeholder="Isi keterangan..." />
                </div>

                <!-- Input untuk Tanggal -->
                <div class="mt-6">
                    <x-splade-input name="date" type="date" label="Tanggal" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <x-splade-submit label="Kirim" />
                </div>
            </x-splade-form>


            </div>
        </div>
    </div>

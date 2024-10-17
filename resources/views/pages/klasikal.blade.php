<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8"
    style="background-image: url({{ asset('img/auth/light_grey_dots_background.jpg') }});">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Menambahkan warna abu-abu pada card -->
        <div class="bg-gray-100 py-8 px-4 shadow sm:rounded-lg sm:px-10 relative">

            <img class="absolute top-0 left-0 h-20 w-auto m-4" src="{{ asset('img/auth/logo-bk.png') }}" alt="Login Icon">
            <img class="absolute top-0 right-0 h-20 w-auto m-4" src="{{ asset('img/auth/logo.png') }}" alt="Logo SMP">

            <h2 class="text-center text-3xl leading-9 font-extrabold text-gray-900 mt-16">
                Layanan Bimbingan Klasikal
            </h2>

            <!-- Membuat button berada di tengah -->
            <div class="text-center mt-4">
                <a href="{{ route('material.kelas7') }}">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                        font-medium rounded-lg text-sm px-5 py-2.5 mx-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none 
                        dark:focus:ring-blue-800">
                        Kelas 7
                    </button>
                </a>
            
                <a href="{{ route('material.kelas8') }}">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                        font-medium rounded-lg text-sm px-5 py-2.5 mx-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none 
                        dark:focus:ring-blue-800">
                        Kelas 8
                    </button>
                </a>
            
                <a href="{{ route('material.kelas9') }}">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                        font-medium rounded-lg text-sm px-5 py-2.5 mx-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none 
                        dark:focus:ring-blue-800">
                        Kelas 9
                    </button>
                </a>
            </div>
            
        </div>
    </div>
</div>

<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Dashboard') }}
    </x-slot>
    <div class="p-5">
        <h1 class="text-3xl">Selamat Datang {{ auth()->user()->name }}, Silahkan Pilih Menu disamping untuk memulai</h1>
        <br>
        
        <!-- Container flex untuk menempatkan card secara sejajar -->
        <div class="flex justify-between space-x-4">
            <!-- Card pertama -->
            <div class="card-klasikal flex-1">
                <a href="layanan-klasikal"
                    class="block h-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-500 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Layanan Klasikal</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400 text-justify">adalah layanan bantuan bagi siswa yang berjumlah antara 30-40 orang melalui kegiatan klasikal yang disajikan secara sistematis, 
                        bersifat preventif dan memberikan pemahaman diri dan pemahaman tentang orang lain yang berorientasi pada bidang 
                        pembelajaran, pribadi, sosial dan karir dengan tujuan menyediakan informasi yang akurat dan dapat membantu 
                        individu untuk merencanakan pengambilan keputusan dalam hidupnya serta mengembangkan potensinya secara optimal.</p>
                </a>
            </div>

            <!-- Card kedua -->
            <div class="card-individual flex-1">
                <a href="individual-service"
                    class="block h-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-500 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Layanan Individual</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400 text-justify">Konseling individu adalah layanan pemberian bantuan yang dilakukan
                        secara wawancara tatap muka antara konselor dan konseli dalam rangka pembahasan dan pengentasan permasalahan
                        pribadi yang dideritanya sehingga klien dapat menggunakan potensinya untuk mencapai kebahagiaan pribadi maupun sosial.
                        Konseling individu merupakan suatu layanan konseling yang diselenggarakan oleh konselorterhadap klien dengan
                        pertemuan yang bersifat individual, artinya pertemuan tersebut dilakukan secara tatap muka oleh dua orang yang
                        disebut konselor dan klien.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

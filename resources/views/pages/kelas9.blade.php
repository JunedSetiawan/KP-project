<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8"
    style="background-image: url({{ asset('img/auth/light_grey_dots_background.jpg') }});">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-gray-100 py-10 px-8 shadow sm:rounded-lg sm:px-12 relative">

            <img class="absolute top-0 left-0 h-20 w-auto m-4" src="{{ asset('img/auth/logo-bk.png') }}" alt="Login Icon">
            <img class="absolute top-0 right-0 h-20 w-auto m-4" src="{{ asset('img/auth/logo.png') }}" alt="Logo SMP">

            <h2 class="text-center text-3xl leading-9 font-extrabold text-gray-900 mt-16">
                Layanan Bimbingan Klasikal
            </h2>

           <!-- Dropdown untuk Semester Ganjil -->
           <details class="mt-6">
            <summary class="text-lg font-bold cursor-pointer">SEMESTER GANJIL</summary>
            <ul class="mt-2">
                @foreach($materiGanjil as $material)
                    <li>
                        <a href="{{ route('material.show', $material->id) }}" class="block py-2">
                            {{ $material->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </details>

        <!-- Dropdown untuk Semester Genap -->
        <details class="mt-6">
            <summary class="text-lg font-bold cursor-pointer">SEMESTER GENAP</summary>
            <ul class="mt-2">
                @foreach($materiGenap as $material)
                    <li>
                        <a href="{{ route('material.show', $material->id) }}" class="block py-2">
                            {{ $material->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </details>

        </div>
    </div>
</div>

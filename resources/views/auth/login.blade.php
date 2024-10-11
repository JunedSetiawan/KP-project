<x-auth-card>
    <div class="">

        <h2 class="text-xl font-bold tracking-wide text-base-content">Sistem Informasi BK dan Pengembangan Peserta Didik ZAPO</h2>
        <hr class="border border-secondary my-4">
        <p class="text-base-content">Selamat Datang, Silahkan Login Terlebih dahulu</p>

        <div class="mt-3">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" />


            <div class="font-semibold">
                <p>Untuk Siswa silahkan login menggunakan <strong>NIS</strong> kalian masing-masing</p>
                <p>contoh : username  = <strong>123456</strong>, password = pass<strong>123456</strong> untuk password nya tidak perlu pisah yaa..</p>
            </div>

            <x-splade-form action="{{ route('store.login') }}" class="space-y-4">
                <!-- Email Address -->
                <x-splade-input id="username" type="text" name="username" :label="__('Username')" required autofocus
                    float="true" />
                <x-splade-input id="password" type="password" name="password" :label="__('Password')" required
                    autocomplete="current-password" float="true" />
                <x-splade-checkbox class="" id="remember_me" name="remember" :label="__('Remember me')" />

                <x-splade-submit class="w-full" :label="__('Masuk')" />

                <div class="mt-6 text-center">
                  Jika ada masalah, silahkan  hubungi <a href="https://wa.me/082365265904" target="_blank"  class="text-blue-600 hover:text-blue-900">Admin</a>
                
                </div>
            </x-splade-form>
        </div>

    </div>

</x-auth-card>
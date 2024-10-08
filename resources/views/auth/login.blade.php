<x-auth-card>
    <div class="">

        <h2 class="text-xl font-bold tracking-wide text-base-content">Sistem Informasi BK dan Pengembangan Peserta Didik ZAPO</h2>
        <hr class="border border-secondary my-4">
        <p class="text-base-content">Selamat Datang, Silahkan Login Terlebih dahulu</p>

        <div class="mt-3">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" />

            <x-splade-form action="{{ route('store.login') }}" class="space-y-4">
                <!-- Email Address -->
                <x-splade-input id="username" type="text" name="username" :label="__('Username')" required autofocus
                    float="true" />
                <x-splade-input id="password" type="password" name="password" :label="__('Password')" required
                    autocomplete="current-password" float="true" />
                <x-splade-checkbox class="" id="remember_me" name="remember" :label="__('Remember me')" />

                <x-splade-submit class="w-full" :label="__('Masuk')" />

                <div class="mt-6 text-center">
                    @if (Route::has('password.request'))
                    <Link class="underline text-sm text-base-content hover:text-neutral"
                        href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                    </Link>
                    @endif
                
                </div>
            </x-splade-form>
        </div>

    </div>

</x-auth-card>
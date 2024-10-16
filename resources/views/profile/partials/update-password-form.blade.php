<section>
    <header>
        <h2 class="text-lg font-medium text-base-content">
            {{ __('Ganti Kata Sandi') }}
        </h2>

        <p class="mt-1 text-sm text-base-content">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <x-splade-form method="put" :action="route('password.update')" class="mt-6 space-y-6" preserve-scroll>
        <x-splade-input id="current_password" name="current_password" type="password" :label="__('Kata Sandi saat ini')"
            autocomplete="current-password" placeholder="Current password" />
        <x-splade-input id="password" name="password" type="password" :label="__('Kata Sandi baru')"
            autocomplete="new-password" placeholder="New password" />
        <x-splade-input id="password_confirmation" name="password_confirmation" type="password"
            :label="__('Konfirmasi Kata Sandi')" autocomplete="new-password" placeholder="Confirm Password" />

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Simpan')" />

            @if (session('status') === 'password-updated')
            <p class="text-sm text-base-content">{{ __('Saved.') }}</p>
            @endif
        </div>
    </x-splade-form>
</section>
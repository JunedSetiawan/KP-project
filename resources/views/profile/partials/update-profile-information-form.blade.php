<section>
    <header>
        <h2 class="text-lg font-medium text-base-content">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-base-content">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <x-splade-form method="patch" :action="route('profile.update')" :default="$user" class="mt-6 space-y-6"
        preserve-scroll>
        <x-splade-input id="name" name="name" type="text" :label="__('Name')" required autofocus autocomplete="name" />
        <x-splade-input id="email" name="email" type="email" :label="__('Email')" required autocomplete="email" />
        <x-splade-input id="username" name="username" type="text" :label="__('Username')" required autocomplete="username" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyusername && ! $user->hasVerifiedEmail())
        <div>
            <p class="text-sm mt-2 text-base-content">
                {{ __('Your email address is unverified.') }}

                <Link method="post" href="{{ route('verification.send') }}"
                    class="underline text-sm text-base-content hover:text-base-content rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Click here to re-send the verification email.') }}
                </Link>
            </p>

            @if (session('status') === 'verification-link-sent')
            <p class="mt-2 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
            @endif
        </div>
        @endif

        <div class="flex items-center gap-4">
            <x-splade-submit :label="__('Simpan')" />

            @if (session('status') === 'profile-updated')
            <p class="text-sm text-base-content">
                {{ __('Saved.') }}
            </p>
            @endif
        </div>
    </x-splade-form>
</section>
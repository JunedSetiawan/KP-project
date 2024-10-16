<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-base-content">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-base-content">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

     <x-splade-form
        method="delete"
        :action="route('profile.destroy')"
        :confirm="__('Apakah Anda yakin ingin menghapus akun Anda?')"
        :confirm-text="__('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.')"
        :confirm-button="__('Hapus Akun')"
        require-password
    >
        <x-splade-submit danger :label="__('Hapus Akun')" />
    </x-splade-form>
</section>

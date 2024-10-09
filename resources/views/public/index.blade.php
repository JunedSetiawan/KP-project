<x-auth-card>
    <div class="">
        <h2 class="text-2xl font-bold tracking-wide">Layanan Informasi</h2>
        <hr class="border border-secondary my-4">

        <div class="mt-6">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" />
            <x-splade-form action="" class="space-y-4">
                <x-splade-input type="text" name="text" :label="__('Pilih BK')" autofocus />
                <x-splade-input type="text" name="text" :label="__('Pilih Kelas')" />
                <x-splade-input type="text" name="text" :label="__('Pilih Siswa')"/>
                <x-splade-input type="text" name="text" :label="__('Keterangan')"/>

                <x-splade-submit class="w-full" :label="__('OKE KANG')" />

                <div class="mt-6 text-center">
                    <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="">
                    </Link>
                </div>
            </x-splade-form>
        </div>
</x-auth-card>
<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-gray-100 py-10 px-8 shadow sm:rounded-lg sm:px-12 relative">
            <h2 class="text-2xl font-bold">{{ $materi->name }}</h2>

            <!-- Jika $detail ada, tampilkan deskripsi dan file -->
            @if ($detail)
                <p class="mt-4">{{ $detail->content ?? 'Tidak ada deskripsi' }}</p>

                @if ($detail->file)
                <p class="mt-4">File: <a href="{{ asset('storage/files/' . $detail->file) }}" class="text-blue-500">{{ basename($detail->file) }}</a></p>
                @else
                    <p class="mt-4">File tidak tersedia</p>
                @endif

                <!-- Tambahkan preview video jika $detail->url_video ada -->
                @if ($detail->url_video)
                    <p class="mt-4">Video: <a href="{{ $detail->url_video }}" target="_blank" class="text-blue-500">Lihat Video</a></p>

                    <!-- Preview Video -->
                    <div class="mt-4">
                        <iframe width="100%" height="315" src="{{ Str::replace('watch?v=', 'embed/', $detail->url_video) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                @else
                    <p class="mt-4">Video tidak tersedia</p>
                @endif
            @else
                <!-- Jika $detail tidak ada, tampilkan pesan bahwa data tidak tersedia -->
                <p class="mt-4">Detail materi tidak tersedia</p>
            @endif
        </div>
    </div>
</div>

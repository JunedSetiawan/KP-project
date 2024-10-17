<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-gray-100 py-10 px-8 shadow sm:rounded-lg sm:px-12 relative">
            <h2 class="text-2xl font-bold">{{ $materi->name }}</h2>
            <p class="mt-4">{{ $materi->content ?? 'Tidak ada deskripsi' }}</p> <!-- Tampilkan deskripsi materi -->
        </div>
    </div>
</div>

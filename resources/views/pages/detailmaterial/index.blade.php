<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Detail Materi') }}
    </x-slot>
    
    

    
    <div class="container mx-auto p-4">
        @if ($detailMaterial)
        <Link slideover href="{{ route('detailmaterial.edit', $detailMaterial->id) }}" class="btn btn-secondary">Edit</Link>
        <div class="card card-compact bg-base-100 w-full shadow-xl mt-4">
            <div class="card-body flex flex-col jusify-center items-center gap-4">
              <h2 class="font-bold text-3xl">{{ $detailMaterial->material->name }}</h2>
              <iframe width="560" height="315" src={{ $detailMaterial->url_video }} title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              <a href="{{ route('document.download', $detailMaterial->file) }}" class="btn btn-primary">
                <x-heroicon-s-arrow-down-tray class="w-5 h-5" /> Download File Materi</a>
              <div class="w-full">
                <h2 class="font-semibold">Deskripsi :</h2>
                <p>{{ $detailMaterial->content }}</p>
              </div>

            </div>
            
          </div>
            <!-- Show the material details -->
            {{-- <h2 class="text-lg font-bold">Material Details</h2>
            <p><strong>Content:</strong> {{ $detailMaterial->content }}</p>
            <p><strong>File:</strong> {{ $detailMaterial->file }}</p>
            <p><strong>Video URL:</strong>{{ $detailMaterial->url_video }}</p> --}}
        @else
        <div class="card card-compact bg-base-100 w-full shadow-xl ">
            <div class="card-body flex flex-col jusify-center items-center gap-4">
                <p>Detail materi masih kosong.</p>
                <Link href="{{ route('detailmaterial.create', $material_id) }}" class="btn btn-secondary">Tambah detail materi</Link>
            </div>
            
          </div>
        @endif
    </div>
</x-app-layout>

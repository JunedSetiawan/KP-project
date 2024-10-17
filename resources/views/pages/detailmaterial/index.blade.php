<x-app-layout>
    <x-slot name="headerNav">
        {{ __('Detail Materi') }}
    </x-slot>
    {{-- <Link href="{{ route('detailmaterial.create') }}" class="btn btn-secondary">Create</Link>
    <div class="card card-compact bg-base-100 w-full shadow-xl">
        <div class="card-body">
          <h2 class="card-title">Shoes!</h2>
          <p>If a dog chews shoes whose shoes does he choose?</p>
          <div class="card-actions justify-end">
            <button class="btn btn-primary">Buy Now</button>
          </div>
        </div>
      </div> --}}

    <div class="container mx-auto p-4">
        @if ($detailMaterial)
            <!-- Show the material details -->
            <h2 class="text-lg font-bold">Material Details</h2>
            <p><strong>Content:</strong> {{ $detailMaterial->content }}</p>
            <p><strong>File:</strong> {{ $detailMaterial->file }}</p>
            <p><strong>Video URL:</strong>{{ $detailMaterial->url_video }}</p>
            <Link confirm href="{{ route('detailmaterial.destroy', $detailMaterial->id) }}" class="btn btn-error" method="DELETE">Delete
            </Link>
        @else
            <!-- Show the button to add material details -->
            <div class="text-center flex flex-col gap-4">
                <p>No detail material found for this material.</p>
                <a href="{{ route('detailmaterial.create', $material_id) }}" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                   Add Detail Material
                </a>
            </div>
        @endif
    </div>
</x-app-layout>

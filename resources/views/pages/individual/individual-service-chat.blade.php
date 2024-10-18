<x-app-layout>
<div class="flex flex-col bg-gray-100 p-4 min-h-screen">
    <!-- Header Chat Room -->
    <div class="bg-white p-4 shadow rounded-t-lg flex justify-between items-center">
      <h2 class="text-lg font-semibold">Layanan Konseling - Chat Room</h2>
      <span class="text-sm text-gray-500">Sesi Konseling</span>
    </div>
  
    <!-- Chat Messages -->
    <div class="flex flex-col flex-grow overflow-y-auto p-4 space-y-4 bg-gray-50">
      <!-- Pesan dari Siswa -->
      <div class="flex items-start gap-2.5">
        <img class="w-8 h-8 rounded-full" src="https://api.dicebear.com/6.x/identicon/svg?scale=75&seed=nama siswa" alt="Siswa image">
        <div class="flex flex-col w-full max-w-[320px] p-4 bg-gray-100 border-gray-200 rounded-xl">
          <div class="flex items-center space-x-2">
            <span class="text-sm font-semibold">Nama Siswa</span>
            <span class="text-sm text-gray-500">11:46</span>
          </div>
          <p class="text-sm py-2 text-gray-900">Curhatan siswa di sini...</p>
          <span class="text-sm text-gray-500">Terkirim</span>
        </div>
        <!-- Optional Dropdown Menu for Actions -->
        <button class="inline-flex self-center p-2 text-gray-500 bg-white rounded-lg hover:bg-gray-100">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
          </svg>
        </button>
      </div>
  
      <!-- Pesan dari Guru BK -->
      <div class="flex items-start gap-2.5 self-end">
        <img class="w-8 h-8 rounded-full" src="https://api.dicebear.com/6.x/identicon/svg?scale=75&seed=guru bk" alt="Guru image">
        <div class="flex flex-col w-full max-w-[320px] p-4 bg-green-100 border-gray-200 rounded-xl">
          <div class="flex items-center space-x-2">
            <span class="text-sm font-semibold">Guru BK</span>
            <span class="text-sm text-gray-500">11:48</span>
          </div>
          <p class="text-sm py-2 text-gray-900">Tanggapan guru di sini...</p>
          <span class="text-sm text-gray-500">Terkirim</span>
        </div>
        <!-- Optional Dropdown Menu for Actions -->
        <button class="inline-flex self-center p-2 text-gray-500 bg-white rounded-lg hover:bg-gray-100">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
          </svg>
        </button>
      </div>
    </div>
  
    <!-- Input Chat -->
    <div class="bg-white p-4 shadow rounded-b-lg flex items-center">
      <input
        type="text"
        placeholder="Tulis pesan..."
        class="flex-grow p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300"
      />
      <button class="ml-4 bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">Kirim</button>
    </div>
  </div>
</x-app-layout>
  
 <!-- Halaman Blog -->
@extends('backend.admin.film.ui')

@section('title', 'Blog')

@section('content')
<!-- Blog Section -->
<section class="text-gray-600 body-font bg-gray-500 min-h-screen">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="text-2xl font-medium title-font mb-4 text-black">Anggota Kelompok</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-black">Berikut adalah anggota kelompok kami dalam proyek ini:</p>
    </div>
    <div class="flex flex-wrap -m-2">
      <!-- Anggota 1 -->
      <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
          <div class="flex-grow">
            <h2 class="text-gray-900 title-font font-medium">Figo Alfa Romeo</h2>
            <p class="text-black">17220596</p>
          </div>
        </div>
      </div>
      <!-- Anggota 2 -->
      <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
          <div class="flex-grow">
            <h2 class="text-gray-900 title-font font-medium">Alkaffi Shyallentino</h2>
            <p class="text-black">17220726</p>
          </div>
        </div>
      </div>
      <!-- Anggota 3 -->
      <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
          <div class="flex-grow">
            <h2 class="text-gray-900 title-font font-medium">Nur Syifa Auliyah</h2>
            <p class="text-black">17220730</p>
          </div>
        </div>
      </div>
      <!-- Anggota 4 -->
      <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
          <div class="flex-grow">
            <h2 class="text-gray-900 title-font font-medium">Sabila Aulia Zahra</h2>
            <p class="text-black">17220470</p>
          </div>
        </div>
      </div>
      <!-- Anggota 5 -->
      <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
        <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
          <div class="flex-grow">
            <h2 class="text-gray-900 title-font font-medium">Alessandro Monnesto De Kock</h2>
            <p class="text-black">17220640</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
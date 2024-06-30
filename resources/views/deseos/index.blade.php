@extends('layout.layout')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .swiper {
      width: 570px;
      height: 650px;
    }

    .swiper-slide {
      display: flex;
      position: relative;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-radius: 18px;
      font-size: 22px;
      font-weight: bold;
      color: #fff;
      background-image: linear-gradient(to right top, #f1b8a7, #e4a9a5, #d39ba2, #c08f9f, #ab849b);
      padding: 2rem 5rem;
      text-shadow: 2px 3px 0px #898999;
      z-index: -1;
    }

    .swiper-slide q {
        z-index: 100;
    }

    .img-contorno {
        position: absolute;
        top: -50px;
        left: 0px;
        width: 970px;
        height: 750px;
        z-index: 2;
    }

    /* .swiper-slide:nth-child(1n) {
      background-color: rgb(206, 17, 17);
    }

    .swiper-slide:nth-child(2n) {
      background-color: rgb(0, 140, 255);
    }

    .swiper-slide:nth-child(3n) {
      background-color: rgb(10, 184, 111);
    }

    .swiper-slide:nth-child(4n) {
      background-color: rgb(211, 122, 7);
    }

    .swiper-slide:nth-child(5n) {
      background-color: rgb(118, 163, 12);
    }

    .swiper-slide:nth-child(6n) {
      background-color: rgb(180, 10, 47);
    }

    .swiper-slide:nth-child(7n) {
      background-color: rgb(35, 99, 19);
    }

    .swiper-slide:nth-child(8n) {
      background-color: rgb(0, 68, 255);
    }

    .swiper-slide:nth-child(9n) {
      background-color: rgb(218, 12, 218);
    }

    .swiper-slide:nth-child(10n) {
      background-color: rgb(54, 94, 77);
    } */
  </style>
@endsection

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
        <div class="mr-6">
            <h1 class="text-4xl font-semibold mb-2">Dashboard</h1>
            <h2 class="text-gray-600 ml-0.5">Deseos de boda</h2>
        </div>
    </div>
    <section class="grid md:grid-cols-1 xl:grid-cols-1 xl:grid-rows-3 xl:grid-flow-col gap-6">
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
            <div class="px-6 py-5 font-semibold border-b border-gray-100">Listado de Deseos</div>
            <div class="p-4 flex-grow">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @forelse ($comentarios as $comentario)
                            <div class="swiper-slide">
                                <img src="{{ asset('images/testi3-frame.png') }}" alt="contorno" class="img-contorno">
                                <q>{{ $comentario->comentario }}</q><br/>
                                <p>- {{ $comentario->nombre }}</p>
                            </div>
                        @empty
                            <div class="flex items-center justify-center">
                                <p class="text-3xl text-gray-500">No se encontrarón deseos</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @vite('resources/js/deseos.js')
@endsection

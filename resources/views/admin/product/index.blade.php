@extends('layouts.admin')
@section('title')
    KaleBurger | Ürünler
@endsection
@section('content')
    <div class=" mb-4  mx-auto max-w-screen-lg w-full">
        <div class="mx-auto rounded-md mb-8">
            <div class="flex justify-between items-center px-1">
                    <h1 class="mb-4 items-start text-2xl  md:text-4xl font-medium">Ürünler</h1>
                    <div>
                        <a href="{{ route('urunler.create') }}"
                            class="mb-4 bg-button text-white text-end px-2.5 py-1.5 rounded-md font-medium text-sm md:text-base tracking-wider hover:bg-white hover:ring-1 hover:ring-button hover:text-button">Yeni
                            Ürün Ekle</a>
                    </div>
                </div>

                <div class=" mx-1">
                    <form id="search-form" action="" method="GET">
                        <div class="mb-4">
                            <label class=" mb-2 block text-xl font-medium text-text" for="search">Ürün Ara</label>
                            <input
                                class="w-full md:w-1/2 ring-input text-text font-medium rounded-md border-0 py-1.5 px-2.5 placeholder:opacity-60 text-base ring-1 placeholder:text-text focus:ring-2 "
                                type="text" name="search" value="{{ request('search') }}"
                                placeholder="Aramak istediğiniz ürünün adını yazın..." id="search">
                        </div>
                        <button
                            class="mb-4  bg-button text-white text-center px-5 py-1.5 rounded-md font-medium  tracking-wider hover:bg-white hover:ring-1 hover:ring-button hover:text-button">
                            Ara
                        </button>
                        <a href="{{ route('urunler.index') }}"
                            class="mb-4  bg-button text-white text-center px-5 py-1.5 rounded-md font-medium  tracking-wider hover:bg-white hover:ring-1 hover:ring-button hover:text-button"
                            {{-- onclick="document.getElementById('search').value = ''; document.getElementById('search-form').submit();" --}}>Sıfırla</a>
                    </form>
                </div>
            <div class="overflow-x-auto">
                
                <table style="color: #6b7280;" class="w-full text-sm text-left rtl:text-right  ">
                    <thead style="color: #374151;" class="text-xs uppercase ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Kategori Adı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ürün Resmi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ürün Adı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ürün Kontrol
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ürün Ebatı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ürün Fiyatı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                İşlemler
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr style=" border-bottom: 1px solid #e5e7eb" class="bg-white ">
                                <th scope="row" class="px-6 py-4 text-text whitespace-nowrap ">
                                    {{ Str::title($product->category->name) }}
                                </th>
                                <td class="px-6 py-4">
                                    <img class="w-24 h-16 object-cover" src="{{ asset('assets/product/' . $product->image_path) }}"
                                        alt="">
                                </td>
                                <th class="px-6 py-4">
                                    {{ Str::title($product->name) }}
                                </th>

                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('admin.urunler.toggle', $product) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <label class="inline-flex items-center me-5 cursor-pointer">
                                            <input type="checkbox" name="is_active" value="" class="sr-only peer"
                                                @if ($product->is_active) checked @endif
                                                onchange="this.form.submit()">
                                            <div
                                                class="relative w-11 h-6 bg-gray200 rounded-full peer d peer-focus:ring-4 peer-focus:ring-green300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-bordergray300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-bggreen600">
                                            </div>
                                        </label>
                                    </form>

                                </td>
                                <td class="px-6 py-4">
                                    <ul class="list-disc list-inside">
                                        @foreach ($product->productOption as $option)
                                            <li>{{ $option->size }}</li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td class="px-6 py-4">
                                    <ul class="list-disc list-inside">
                                        @foreach ($product->productOption as $option)
                                            <li>{{ $option->price }} TL</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <th scope="row" class="px-6 py-4  text-text whitespace-nowrap ">
                                    <div>
                                        <a class="bg-greenbg text-white text-end px-2.5 py-1.5 rounded-md font-medium tracking-wider hover:bg-greenhover hover:ring-1  hover:text-white"
                                            href="{{ route('urunler.edit', $product) }}">Düzenle</a>
                                        <button
                                            class="bg-errortext ml-2 hover:bg-errorhover text-white text-end px-2.5 py-1.5 rounded-md font-medium tracking-wider  hover:ring-1  hover:text-white"
                                            data-id="{{ $product->id }}" onclick="openModal(this)">Sil</button>

                                        {{-- modal start --}}


                                        <div id="popup-modal" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-head bg-opacity-50">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <button type="button" onclick="closeModal()"
                                                        class="absolute top-3 end-2.5 bg-transparent text-text hover:opacity-75 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                        data-modal-hide="popup-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">İptal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-text w-12 h-12" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-text ">
                                                            Bu ürünü silmek istediğine emin misin?</h3>
                                                        <div class="flex space-x-4 justify-center">
                                                            {{-- silmeyi ekle  --}}
                                                            <form id="delete-form" action="#" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button data-modal-hide="popup-modal" type="submit"
                                                                    class="text-white cursor-pointer bg-errortext hover:bg-errorhover focus:ring-4 focus:outline-none focus:bg-ring font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                    Evet
                                                                </button>
                                                            </form>

                                                            <button data-modal-hide="popup-modal" type="button"
                                                                onclick="closeModal()"
                                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-text focus:outline-none bg-white rounded-lg border border-border hover:bg-text hover:text-white focus:z-10 focus:ring-4 ">
                                                                Hayır
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal end --}}
                                    </div>
                                </th>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openModal(button) {
            var modal = document.getElementById('popup-modal');
            var productId = button.getAttribute('data-id');

            // Silme formunun action alanını güncelle
            var form = document.getElementById('delete-form');
            form.action = '/admin/urunler/' + productId;

            // Modal'ı göster
            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('popup-modal').classList.add('hidden');
        }
    </script>
@endsection
@extends('layouts.admin')
@section('title')
    KaleBurger | Kategoriler
@endsection
@section('content')
    <div class=" mb-4  mx-auto max-w-screen-lg w-full">

        <div class="mx-auto rounded-md mb-8 items-center">
            <div class="flex justify-between items-center px-1">
                <h1 class=" items-start  text-2xl  md:text-4xl font-medium">Kategoriler</h1>
                <div>
                    <a href="{{ route('kategoriler.create') }}"
                        class="mb-4 bg-button text-white text-end px-2.5 py-1.5 rounded-md font-medium text-sm md:text-base tracking-wider hover:bg-white hover:ring-1 hover:ring-button hover:text-button">Yeni
                        Kategori Ekle</a>
                </div>
            </div>
            <div class="overflow-x-auto w-full">

                <table style="color: #6b7280;" class="w-full  text-sm text-left rtl:text-right  ">
                    <thead style="color: #374151;" class="text-xs uppercase ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Kategori Resmi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kategori Adı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                İşlemler
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr style=" border-bottom: 1px solid #e5e7eb" class="bg-white border-b">
                                <td class="px-6 py-4">
                                    <img class="w-24 h-16 object-cover"
                                        src="{{ asset('assets/category/' . $category->image_path) }}" alt="">
                                </td>
                                <th scope="row" class="px-6 py-4  text-text whitespace-nowrap ">
                                    {{ Str::title($category->name) }}
                                </th>
                                <th scope="row" class="px-6 py-4  text-text whitespace-nowrap ">
                                    <div>
                                        <a class="bg-greenbg text-white  text-end px-2.5 py-1.5 rounded-md font-medium tracking-wider hover:bg-greenhover hover:ring-1  hover:text-white"
                                            href="{{ route('kategoriler.edit', $category) }}">Düzenle</a>
                                        <button
                                            class="bg-errortext ml-2  hover:bg-errorhover text-white text-end px-2.5 py-1.5 rounded-md font-medium tracking-wider  hover:ring-1  hover:text-white"
                                            data-id="{{ $category->id }}" onclick="openModal(this)">Sil</button>

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
                                                            Bu Kategoriyi silmek istediğine emin misin?</h3>
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
            var categoryId = button.getAttribute('data-id');

            // Silme formunun action alanını güncelle
            var form = document.getElementById('delete-form');
            form.action = '/admin/kategoriler/' + categoryId;

            // Modal'ı göster
            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('popup-modal').classList.add('hidden');
        }
    </script>
@endsection

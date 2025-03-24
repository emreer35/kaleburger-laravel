@extends('layouts.admin')
@section('title')
    KaleBurger | Ürün Ekle
@endsection

@section('content')
    <div class="mx-auto bg-white grid grid-cols-1 gap-4 max-w-screen-lg w-full px-8 py-4">
        <form action="{{route('urunler.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center w-full mb-4">
                <label for="dropzone-file" id="dropzone-label"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6" id="dropzone-content">
                        <svg class="w-8 h-8 mb-4 text-text " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-text "><span class="font-semibold">Yüklemek için tıklayın</span></p>

                    </div>
                    <input id="dropzone-file" type="file" class="hidden" name="file" />
                </label>
            </div>

            @if ($errors->has('file'))
                <div class="bg-ring border border-ring text-errortext px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Hata!</strong>
                    <span class="block sm:inline">{{ $errors->first('file') }}</span>
                </div>
            @endif
            <div class="mb-2 md:mb-4">
                <label class="mb-1 md:mb-2 block text-base md:text-lg font-medium text-text"
                    for="category_id">Kategoriler</label>
                <select name="category_id" id="category_id"
                    class="bg-gray50 border border-gray300 text-text text-sm md:text-base rounded-lg lg:w-1/2  focus:ring-blue500 focus:border-blue500 block w-full py-1.5 px-2.5 ">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-1  gap-2 md:gap-4 ">
                <div>
                    <label class="mb-1 md:mb-2 block text-base md:text-lg font-medium text-text" for="name">Ürün
                        adı</label>
                    <input
                        class="w-full ring-input lg:w-1/2 text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm md:text-base ring-1 placeholder:text-text focus:ring-2 placeholder:opacity-60 "
                        type="text" name="name" id="name" placeholder="Ürün Adı">
                        @if ($errors->has('name'))
                        <div class="mt-1 text-xs text-errortext">
                            {{$errors->first('name')}}
                        </div>
                        @endif
                </div>
                <div>
                    <label class="mb-1 md:mb-2 block text-base md:text-lg font-medium text-text" for="content">Ürün
                        Açıklaması</label>
                    <textarea
                        class="w-full ring-input text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm md:text-base ring-1 placeholder:text-text focus:ring-2 placeholder:opacity-60"
                        type="text" name="content" id="content" placeholder="Ürün Açıklaması"></textarea>
                        @if ($errors->has('content'))
                        <div class="mt-1 text-xs text-errortext">
                            {{ $errors->first('content')}}
                        </div>
                        @endif
                </div>
            </div>
            {{-- options --}}
            <div id="options" class="grid grid-cols-2 gap-4 mb-4">
                
                <div>
                    <label class="mb-1 md:mb-2 block text-base md:text-lg font-medium text-text" for="sizes1">Ürün
                        Gramajı</label>
                    <input
                        class="w-full ring-input  text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm md:text-base ring-1 placeholder:text-text focus:ring-2 placeholder:opacity-60 "
                        type="text" name="sizes[]" id="sizes" placeholder="Ürün Gramajı">
                        @if ($errors->has('sizes.0'))
                        <div class="mt-1 text-xs text-errortext">
                            {{ $errors->first('sizes.0')}}
                        </div>
                        @endif
                </div>
                <div>
                    <label class="mb-1 md:mb-2 block text-base md:text-lg font-medium text-text" for="prices1">Ürün
                        Fiyatı</label>
                    <input
                        class="w-full ring-input  text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm md:text-base ring-1 placeholder:text-text focus:ring-2 placeholder:opacity-60 "
                        type="number" name="prices[]" id="prices" placeholder="Ürün Fiyatı">
                        @if ($errors->has('prices.0'))
                        <div class="mt-1 text-xs text-errortext">
                            {{ $errors->first('prices.0')}}
                        </div>
                        @endif
                </div>
            </div>
            {{-- end options --}}
            <div class="text-center lg:text-right">
                <button id="add-option" type="button"
                    class="bg-greenbg w-full text-white text-center px-2.5 py-1.5 rounded-md font-medium text-sm md:text-base hover:bg-greenhover hover:ring-1  hover:text-white">Yeni
                    Opsiyon Ekle</button>
            </div>

            <button type="submit" id="updateAvatarBtn"
                class="bg-greenbg hover:bg-greenhover text-white text-sm md:text-base  font-bold py-2 px-4 rounded inline-flex justify-center items-center mt-2 ">
                <svg class="h-5 w-5 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="16" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
                Ürün Ekle
            </button>


        </form>
    </div>

    <script>
        document.getElementById('dropzone-file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                // Okuma işlemi tamamlandığında
                reader.onload = function(e) {
                    // Önceki içeriği kaldır
                    document.getElementById('dropzone-content').innerHTML = '';

                    // Yeni img elementini oluştur
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-full', 'h-60', 'object-contain', 'rounded-lg');

                    // Dropzone içine görseli ekle
                    document.getElementById('dropzone-content').appendChild(img);
                }

                // Dosya okuma işlemini başlat
                reader.readAsDataURL(file);
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            let optionCounter = 1;
            const addOptionBtn = document.getElementById('add-option')
            const optionContainer = document.getElementById('options')

            addOptionBtn.addEventListener('click', function() {
                optionCounter++

                const newOptions = `
            <div>
                    <label class="mb-1 md:mb-2 block text-base md:text-lg font-medium text-text" for="sizes${optionCounter}">Ürün
                        Gramajı</label>
                    <input
                        class="w-full ring-input  text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm md:text-base ring-1 placeholder:text-text focus:ring-2 placeholder:opacity-60 "
                        type="text" name="sizes[]" id="sizes${optionCounter}" placeholder="Ürün Gramajı">
                </div>
                <div>
                    <label class="mb-1 md:mb-2 block text-base md:text-lg font-medium text-text" for="prices${optionCounter}">Ürün
                        Fiyatı</label>
                    <input
                        class="w-full ring-input  text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm md:text-base ring-1 placeholder:text-text focus:ring-2 placeholder:opacity-60 "
                        type="number" name="prices[]" id="prices${optionCounter}" placeholder="Ürün Fiyatı">
                </div>
            `

                optionContainer.insertAdjacentHTML('beforeend', newOptions)
            })
        })
    </script>
@endsection
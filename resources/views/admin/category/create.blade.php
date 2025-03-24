@extends('layouts.admin')
@section('title')
    KaleBurger | Kategori Ekle
@endsection
@section('content')
    <div class="mx-auto bg-white grid grid-cols-1 gap-4 max-w-screen-lg w-full px-8 py-4">
        <form action="{{ route('kategoriler.store') }}" method="post" enctype="multipart/form-data">
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
            <div class="mb-4 ">
                <label class="mb-1 md:mb-2 block text-base md:text-xl font-medium text-text" for="">Kategori Adı</label>
                <input
                    class="w-full md:w-1/2 ring-input text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm md:text-lg ring-1 placeholder:text-text focus:ring-2 "
                    type="text" name="category_name">
            </div>

            <button type="submit" id="updateAvatarBtn"
                class="bg-greenbg hover:bg-greenhover text-white text-sm md:text-base   font-bold py-2 px-4 rounded inline-flex justify-center items-center mt-2">
                <svg class="h-5 w-5 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="16" />
                    <line x1="8" y1="12" x2="16" y2="12" />
                </svg>
                Kategori Oluştur
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
    </script>
@endsection

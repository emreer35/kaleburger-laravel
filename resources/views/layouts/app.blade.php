<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{asset('assets/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('build/assets/app-cEeM3A3H.css')}}">
</head>

<body class="bg-gray">
    <nav class=" py-1 " style="@yield('bg-style')">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-md lg:max-w-4xl xl:max-w-6xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <a class="flex space-x-3 items-center" href="{{ route('categories.index') }}">
                        <img class="h-20" src="{{ asset('assets/logo.png') }}" alt="Kale Burger Logo">
                    </a>
                    <span class="font-semibold text-xl ">@yield('name')</span>
                </div>
                <div>
                    <ul class="flex space-x-2 items-center">
                        <li class="w-8">
                            <a href="https://www.instagram.com/kaleburgeer/"><img class="w-full h-full"
                                    src="{{ asset('assets/instagram.png') }}" alt=""></a>
                        </li>
                        <li class="h-7">
                            <a class="flex @yield('number-color') font-medium" href="https://wa.me/5306414250">
                                <img class="mr-2 w-7 h-full" src="{{ asset('assets/whatsapp.png') }}" alt="">
                                0530 641 42 50
                            </a>
                        </li>

                    </ul>
                </div>
            </div>


        </div>
    </nav>
    {{-- breadcrumb --}}

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 max-w-screen-md lg:max-w-4xl xl:max-w-6xl">
        @yield('content')
    </div>

    <footer class=" bg-text pt-12">
        {{-- container --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-md lg:max-w-4xl xl:max-w-6xl">
            <div class="gap-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mb-8">
                {{-- logo --}}
                <div class="flex flex-col items-center  mb-4">
                    <img class="w-40 mb-4" src="{{ asset('assets/logo.png') }}" alt="Kaleburger_logo">

                   
                </div>
                <div class="flex flex-col items-center md:items-start mb-4">
                    <div class="mb-4 font-medium text-white text-xl tracking-wider ">İletişim Bilgileri</div>
                    {{-- <div style="width: 8.8rem; height: 2px; background-color: white" class="mt-1"></div> --}}
                    <div class="mb-4 text-md ">
                        <span class="text-white font-medium">Adres:</span>
                        <span class="text-button">2000 Evler, 37. Yol, 50300 Nevşehir Merkez/Nevşehir</span>
                    </div>
                    <div class="mb-4 text-md">
                        <span class="text-white font-medium">Telefon:</span>
                        <span class="text-button">0530 641 42 50</span>
                    </div>
                    <div class="mb-4 text-md">
                        <span class="text-white font-medium">Email:</span>
                        <span class="text-button ">blablabal@gmail.com</span>
                    </div>

                </div>
                {{-- map --}}
                <div class="flex flex-col items-center md:items-start">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3115.099018557071!2d34.73251947633669!3d38.66959236011288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x152a6ff5cfe1474f%3A0xe3687a145254f3c1!2sKALE%20BURGER!5e0!3m2!1str!2str!4v1725637993895!5m2!1str!2str"
                        width="350" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="text-center pb-2 text-white">
                <p class="font-medium">&copy; {{ date('Y') }} <a class="text-button font-semibold hover:text-white hover:underline" href="https://emreer.com.tr/">emreer.com.tr</a>. Tüm Hakları Saklıdır.</p>
            </div>
        </div>

    </footer>
</body>

</html>

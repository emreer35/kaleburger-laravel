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

    {{-- <nav class=" py-1 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-md lg:max-w-4xl xl:max-w-6xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <a class="flex space-x-3 items-center" href="">
                        <img class="h-20" src="{{ asset('assets/logo.png') }}" alt="Kale Burger Logo">
                    </a>
                    <span class="font-semibold text-xl ">Admin Dashboard</span>
                </div>
                @auth
                    <form action="{{ route('auth.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div>
                            <button type="submit">Sign Out</button>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    </nav> --}}

    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-text rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>


    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0  bg-white"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 relative">
            {{-- close button --}}
            <button type="button"
                class="absolute top-4 right-4 p-2 text-gray-500 hover:text-gray-900 focus:outline-none md:hidden"
                onclick="toggleSidebar()">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.index') }}"><img class="w-20  mx-auto" src="{{ asset('assets/logo.png') }}"
                            alt=""></a>
                </li>
                <li>
                    <a href="{{ route('admin.index') }}"
                        class="flex items-center p-2  rounded-lg  text-text hover:bg-button hover:text-white group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-text transition duration-75 rounded-lg group hover:bg-button hover:text-white "
                        aria-controls="category-dropdown" data-collapse-toggle="category-dropdown"
                        onclick="toggleDropdown('category-dropdown')">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Kategori</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="category-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('kategoriler.index') }}"
                                class="flex items-center w-full p-2 text-text hover:bg-button hover:text-white group transition duration-75 rounded-lg pl-11 group ">Tüm
                                Kategoriler</a>
                        </li>
                        <li>
                            <a href="{{ route('kategoriler.create') }}"
                                class="flex items-center w-full p-2 text-text hover:bg-button hover:text-white group transition duration-75 rounded-lg pl-11 group ">Kategori
                                Ekle</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-text transition duration-75 rounded-lg group hover:bg-button hover:text-white "
                        aria-controls="product-dropdown" data-collapse-toggle="product-dropdown"
                        onclick="toggleDropdown('product-dropdown')">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Ürünler</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="product-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('urunler.index') }}"
                                class="flex items-center w-full p-2 text-text hover:bg-button hover:text-white group transition duration-75 rounded-lg pl-11 group ">Tüm
                                Ürünler</a>
                        </li>
                        <li>
                            <a href="{{ route('urunler.create') }}"
                                class="flex items-center w-full p-2 text-text hover:bg-button hover:text-white group transition duration-75 rounded-lg pl-11 group ">Ürün
                                Ekle</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <form action="{{ route('auth.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            class="flex items-center p-2 w-full  rounded-lg text-text hover:bg-button hover:text-white group">
                            <svg class="flex-shrink-0 w-5 h-5  transition duration-75 dark:text-gray-400 group-hover:text-text dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                            </svg>
                            <span class=" ms-3 whitespace-nowrap">Çıkış Yap</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </aside>



    <div class="p-4 md:ml-64">
        <div class="p-4 rounded-lg">
            <div class="flex items-center mb-4 rounded-md">
                @yield('content')
                @if (session('success'))
                    <div id="successAlert"
                        class="fixed top-4 right-4 bg-green100 border border-green400 text-green700 px-4 py-3 rounded-lg shadow-lg"
                        role="alert">
                        <div class="font-bold">Başarılı!</div>
                        <span class="block sm:inline md:pr-6">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg id="closeAlert" class="fill-current h-6 w-6 text-green-500 cursor-pointer"
                                role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Kapat</title>
                                <path
                                    d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.934 2.935a1 1 0 11-1.414-1.414L8.586 10 5.651 7.065a1 1 0 111.414-1.414L10 8.586l2.934-2.935a1 1 0 011.414 1.414L11.414 10l2.934 2.935a1 1 0 010 1.414z" />
                            </svg>
                        </span>
                    </div>
                @endif

                @if (session('error'))
                    <div id="errorAlert"
                        class="fixed top-4 right-4 bg-red100 border border-red400 text-red700 px-4 py-3 rounded-lg shadow-lg mt-4"
                        role="alert">
                        <div class="font-bold">Hata!</div>
                        <span class="block sm:inline md:pr-6">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg id="closeErrorAlert" class="fill-current h-6 w-6 text-red-500 cursor-pointer"
                                role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Kapat</title>
                                <path
                                    d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.934 2.935a1 1 0 11-1.414-1.414L8.586 10 5.651 7.065a1 1 0 111.414-1.414L10 8.586l2.934-2.935a1 1 0 011.414 1.414L11.414 10l2.934 2.935a1 1 0 010 1.414z" />
                            </svg>
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>







    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-multi-level-sidebar');
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('translate-x-0');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.querySelector('[data-drawer-toggle]');
            toggleButton.addEventListener('click', toggleSidebar);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const closeAlertButton = document.getElementById('closeAlert');
            const successAlert = document.getElementById('successAlert');

            if (closeAlertButton) {
                closeAlertButton.addEventListener('click', function() {
                    successAlert.style.display = 'none';
                });
            }
            const closeErrorAlertButton = document.getElementById('closeErrorAlert');
            const errorAlert = document.getElementById('errorAlert');

            if (closeErrorAlertButton) {
                closeErrorAlertButton.addEventListener('click', function() {
                    errorAlert.style.display = 'none';
                });
            }
        });
    </script>
</body>


</body>

</html>

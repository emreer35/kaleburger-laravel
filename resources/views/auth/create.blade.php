<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KaleBurger | Login</title>
    <link rel="icon" href="{{asset('assets/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('build/assets/app-cEeM3A3H.css')}}">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray">

    <nav class=" py-1 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-md lg:max-w-4xl xl:max-w-6xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <a class="flex space-x-3 items-center" href="">
                        <img class="h-20" src="{{ asset('assets/logo.png') }}" alt="Kale Burger Logo">
                    </a>
                    <span class="font-semibold text-xl ">Admin Dashboard</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 max-w-screen-md lg:max-w-4xl xl:max-w-6xl">


        <div class="md:mt-40 mt-10 max-w-md mx-auto justify-center  h-full ">
            <div class="bg-white px-14 py-8 rounded-md ">
                <div class="flex flex-col items-center">
                    <img class="w-32 mb-4" src="{{ asset('assets/logo.png') }}" alt="">
                    <div class="text-3xl font-medium text-center mb-4 text-head">
                        Admin Login
                    </div>
                </div>
                @php
                    $name = 'email';
                    $hasErrors = $errors->has($name);
                    $password = 'password';
                    $hasPassword = $errors->has($password);
                @endphp
                <form action="{{ route('auth.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="mb-2 block text-lg font-medium text-text ">Email</label>
                        <input
                            class="w-full text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 ring-input placeholder:text-text placeholder:opacity-50 focus:ring-2
                         {{ $hasErrors ? 'ring-ring' : '' }}"
                            type="text" name="email" id="email" placeholder="example@gmail.com"
                            value="{{ old('email') }}">
                        @error($name)
                            <div class="mt-1 text-xs text-errortext">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="mb-2 block text-lg font-medium text-text">Password</label>
                        <input
                            class="w-full ring-input text-text font-medium rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-text focus:ring-2 
                        {{ $hasPassword ? 'ring-ring' : '' }}"
                            type="password" name="password" id="password">
                        @error($password)
                            <div class="mt-1 text-xs text-errortext">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button
                        class="mb-4 bg-button text-white w-full px-2.5 py-1.5 rounded-md font-medium tracking-wider hover:bg-white hover:ring-1 hover:ring-button hover:text-button">Giriş
                        Yap</button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>

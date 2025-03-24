@extends('layouts.app')
@section('title')
    KaleBurger | QrMenu
@endsection
@section('bg-style')
background-color:#FFFFFF;
@endsection
@section('number-color')
    text-text
@endsection
@section('name')
KaleBurger Menu
@endsection
@section('content')
    {{-- breadcrumbs --}}
    <x-bread-crumb class="mb-4" :links="['Menu'=>route('categories.index')]" />
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($categories as $category)
            <a href="{{route('category-show',$category->slug)}}" class=" rounded-md relative h-40  overflow-hidden shadow-xl ">
                <img class="bg-contain w-full h-full rounded-md object-cover z-0" src="{{ asset('assets/category/'.$category->image_path) }}"
                    alt="{{ $category->name }}">
                <!-- Gradient Layer -->
               <!-- Gradient Layer -->
               <div class="absolute inset-0 bg-custom-gradient z-10 opacity-60"></div>
                <div class="absolute bottom-6 left-6 text-3xl font-bold text-white z-20 ">
                    {{ Str::title($category->name) }}
                </div>

            </a>
        @endforeach
    </div>
   
@endsection 


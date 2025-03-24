@extends('layouts.app')
@section('title')
    KaleBurger | {{Str::title($categories->name)}}
@endsection
@section('bg-style')
    background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)),
    url('{{ asset('assets/category/' . $categories->image_path) }}');
    background-size: cover;
    background-position: center;
    color: #ffffff;
@endsection
@section('number-color')
    text-white
@endsection
@section('name')
    <a href="{{ route('category-show', $categories->slug) }}">{{ Str::ucfirst($categories->name) }}</a>
@endsection


@section('content')
    <x-bread-crumb class="mb-4" :links="['Menu' => route('categories.index'), Str::ucfirst($categories->name) => '#']" />

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse ($products as $product)
            <div
                class="relative bg-white rounded-md px-4 py-5 flex items-center 
                @if (!$product->is_active) text-white @endif">

                <img class="w-28 mr-4" src="{{ asset('assets/product/' . $product->image_path) }}" alt="">

                <div class="flex-1">
                    <div class="text-head font-medium text-md mb-2">{{ Str::title($product->name) }}</div>
                    <p class="text-xs text-text mb-2">{{ $product->content }}</p>
                    {{-- option --}}
                    @forelse ($product->productOption as $option)
                        <div
                            class="rounded-md border border-input p-1 mb-2 max-w-40 flex justify-center
                            @if (!$product->is_active) border-gray-500 @endif">
                            <div class="flex space-x-2">
                                <span class="text-sm @if (!$product->is_active) text-gray400 @endif">
                                    {{ $option->size }} →
                                </span>
                                <span class="text-sm @if (!$product->is_active) text-gray400 @endif">
                                    @if (!$product->is_active)
                                        - -
                                    @else
                                        {{ $option->price }} TL
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                    @empty
                        @if (!$product->is_active)
                            <div class="text-gray400">Fiyat bilgisi mevcut değil.</div>
                        @endif
                    @endforelse
                </div>

                {{-- black overlay --}}
                @if (!$product->is_active)
                    <div class="absolute px-4 py-5 inset-0 bg-head opacity-65 flex items-center justify-center rounded-md ">
                        <span class="text-white font-bold text-xl tracking-widest">Tükendi</span>
                    </div>
                @endif

            </div>
        @empty
            <p>Ürün bulunamadı</p>
        @endforelse
    </div>
@endsection

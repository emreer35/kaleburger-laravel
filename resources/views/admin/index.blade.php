@extends('layouts.admin')
@section('title')
    KaleBurger | Admin Dashboard
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-8 mb-4 lg:grid-cols-2">

        <div class="flex  rounded-md mb-8 ">
            <div class="overflow-x-auto w-full">
                <h1 class="mb-4 items-start text-2xl  md:text-4xl font-medium">Kategoriler</h1>
                <table style="color: #6b7280;" class="w-full text-sm text-left rtl:text-right  ">
                    <thead style="color: #374151;" class="text-xs uppercase ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Kategori Resmi
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kategori Adı
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr style=" border-bottom: 1px solid #e5e7eb" class="bg-white border-b">
                                <td class="px-6 py-4 ">
                                    <img class="w-24  h-16 object-cover "
                                        src="{{ asset('assets/category/' . $category->image_path) }}" alt="">
                                </td>
                                <th scope="row" class="px-6 py-4  text-text whitespace-nowrap ">
                                    {{ Str::ucfirst($category->name) }}
                                </th>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


        <div class="flex justify-center rounded-md mb-8">
            <div class="overflow-x-auto">
                <h1 class="mb-4 items-start text-2xl  md:text-4xl font-medium">Ürünler</h1>
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
                                Ürün Ebatı
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ürün Fiyatı
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr style=" border-bottom: 1px solid #e5e7eb" class="bg-white ">
                                <th scope="row" class="px-6 py-4 text-text whitespace-nowrap ">
                                    {{ Str::ucfirst($product->category->name) }}
                                </th>
                                <td class="px-6 py-4">
                                    <img class="w-24  h-16 object-cover" src="{{ asset('assets/product/'.$product->image_path) }}" alt="">
                                </td>
                                <th class="px-6 py-4">
                                    {{ Str::ucfirst($product->name) }}
                                </th>
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
                                            <li>{{ $option->price }} ₺</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

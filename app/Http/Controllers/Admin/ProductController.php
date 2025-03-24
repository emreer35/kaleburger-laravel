<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('productOption', 'category')->when($request->search, function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('category', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
        })->get();

        return view('admin.product.index', [
            'products' => $products
        ]);
    }
    public function toggle(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = $request->has('is_active');
        $product->save();
        return redirect()->back()->with('success', 'Ürün Kontrolü başarıyla güncellendi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', [
            'categories' => $categories,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'file' => 'required|image|mimes:jpg,jpeg,svg,png',
            'category_id' => 'required',
            'name' => 'required|string',
            'content' => 'required|string',
            'sizes.*' => 'required|string',
            'prices.*' => 'required|numeric'
        ];
        $messages = [
            'file.required' => 'Lütfen bu alanı doldurunuz.',
            'file.mimes' => 'Lütfen jpg, jpeg, png, svg dosya dosya uzantılarını kullanınız.',
            'file.image' => 'Lütfen bir resim seçiniz.',
            'name.required' => 'Lütfen bu alanı doldurunuz.',
            'content.required' => 'Lütfen bu alanı doldurunuz.',
            'sizes.*.required' => 'Lütfen bu alanı doldurunuz.',
            'prices.*.required' => 'Lütfen bu alanı doldurunuz.',
            'prices.*.numeric' => 'Fiyatlar geçerli bir sayı olmalıdır.',
        ];

        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = 'assets/product';
            $file->move(public_path($filePath), $fileName);
        }


        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->content = $request->content;
        $product->image_path = $fileName;
        $product->save();

        $sizes = $request->sizes;
        $prices = $request->prices;

        if (is_array($sizes) && is_array($prices)) {
            foreach ($sizes as $index => $size) {
                $price = isset($prices[$index]) ? $prices[$index] : null;
                if ($price !== null) {
                    $option = new ProductOption();
                    $option->product_id = $product->id;
                    $option->size = $size;
                    $option->price = $price;
                    $option->save();
                }
            }
        }

        return redirect()->route('urunler.index')->with('success', 'Ürün Başarıyla Eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::with('productOption')->findOrFail($id);
        return view('admin.product.edit', [
            'categories' => $categories,
            'product' => $product
        ]);
    }
    public function changeImage(Request $request, string $id)
    {
        $product = Product::with('productOption')->findOrFail($id);
        $data = $request->all();
        $rules = [
            'file' => 'required|mimes:jpg,jpeg,svg,png|image',
        ];
        $messages = [
            'file.required' => 'Lütfen bu alanı doldurunuz.',
            'file.mimes' => 'Lütfen jpg, jpeg, png, svg dosya dosya uzantılarını kullanınız.',
            'file.image' => 'Lütfen bir resim seçiniz.',
        ];
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        if ($request->hasFile('file')) {
            // Eski resmi sil
            if ($product->image_path && file_exists(public_path('assets/product/' . $product->image_path))) {
                unlink(public_path('assets/product/' . $product->image_path));
            }
            // yeni resmi ekle 
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = 'assets/product';
            $file->move(public_path($filePath), $fileName);
            $product->image_path = $fileName;
            $product->save();
        }
        return redirect()->route('urunler.index')->with('success', 'Ürün resmi başarıyla değiştirildi.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->all();
        $rules = [
            'category_id' => 'required',
            'name' => 'required|string',
            'content' => 'required|string',
            'sizes.*' => 'required|string',
            'prices.*' => 'required|numeric'
        ];
        $messages = [
            'name.required' => 'Lütfen bu alanı doldurunuz.',
            'content.required' => 'Lütfen bu alanı doldurunuz.',
            'sizes.*.required' => 'Lütfen bu alanı doldurunuz.',
            'prices.*.required' => 'Lütfen bu alanı doldurunuz.',
            'prices.*.numeric' => 'Fiyatlar geçerli bir sayı olmalıdır.',
        ];

        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->content = $request->content;
        $product->save();

        $sizes = $request->sizes;
        $prices = $request->prices;

        ProductOption::where('product_id', $product->id)->delete();

        if (is_array($sizes) && is_array($prices)) {
            foreach ($sizes as $index => $size) {
                $price = isset($prices[$index]) ? $prices[$index] : null;
                if ($price !== null) {
                    $option = new ProductOption();
                    $option->product_id = $product->id;
                    $option->size = $size;
                    $option->price = $price;
                    $option->save();
                }
            }
        }
        return redirect()->route('urunler.index')->with('success', 'Ürün Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_path && file_exists(public_path('assets/product/' . $product->image_path))) {
            unlink(public_path('assets/product/' . $product->image_path));
        }
        $product->delete();

        return redirect()->route('urunler.index')->with('success', 'Ürün başarıyla silindi.');
    }
}

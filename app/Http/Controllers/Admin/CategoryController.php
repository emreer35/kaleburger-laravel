<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'file' => 'required|mimes:jpg,jpeg,svg,png|image',
            'category_name' => 'required|string'
        ];
        $messages = [
            'file.required' => 'Lütfen bu alanı doldurunuz.',
            'file.mimes' => 'Lütfen jpg, jpeg, png, svg dosya dosya uzantılarını kullanınız.',
            'file.image' => 'Lütfen bir resim seçiniz.',
            'category_name.required' => 'Lütfen bu alanı doldurunuz.'
        ];

        $validation = Validator::make($data, $rules, $messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = 'assets/category';
            $file->move(public_path($filePath), $fileName);
        }
        

        $category = new Category();
        $category->name = $request->category_name;
        $category->image_path = $fileName;
        $category->slug = Str::slug($request->category_name);
        $category->save();

        return redirect()->route('kategoriler.index')->with('success', 'Kategori başarıyla eklendi.');
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
    public function edit(Category $kategoriler)
    {

        return view(
            'admin.category.edit',
            [
                'category' => $kategoriler
            ]
        );
    }
    public function changeImage(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
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
        if ($category->image_path && file_exists(public_path('assets/category/' . $category->image_path))) {
            unlink(public_path('assets/category/' . $category->image_path));
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = 'assets/category';
            $file->move(public_path($filePath), $fileName);
            $category->image_path = $fileName;
            $category->save();
        }

        
        return redirect()->route('kategoriler.index')->with('success', 'Kategori resmi başarıyla güncellendi.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->all();
        $rules = [
            'category_name' => 'required|string'
        ];
        $messages = [
            'category_name.required' => 'Lütfen bu alanı doldurunuz.'
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category->name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->save();

        return redirect()->route('kategoriler.index')->with('success', 'Kategori başarıyla güncellendi.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $category = Category::findOrFail($id);
        if ($category->image_path && file_exists(public_path('assets/category/' . $category->image_path))) {
            unlink(public_path('assets/category/' . $category->image_path));
        }
        $category->delete();

        return redirect()->route('kategoriler.index')->with('success', 'Kategori başarıyla silindi.');
    }
}

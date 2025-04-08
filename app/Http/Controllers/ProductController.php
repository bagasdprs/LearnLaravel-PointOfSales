<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Products";
        // select * from product LEFT JOIN categories ON categories.id = products.category_id
        // ORM : Object Relational Mapping
        $datas = Products::with('categories')->get();
        return view('products.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::orderby('id', 'desc')->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo')->store('products', 'public');
            $data['product_photo'] = $photo;
        }

        Products::create($data);
        return redirect()->to('products');
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
        $edit = Products::find($id);
        $categories = Categories::orderby('id', 'desc')->get();
        // $categories = Categories::all();
        return view('products.edit', compact('edit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = [
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active,
        ];

        $product = Products::find($id);
        if ($request->hasFile('product_photo')) {
            // JIka gambar sudah ada dan mau diubah, maka gambar lama dihapus
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->product_photo));
            }

            $photo = $request->file('product_photo')->store('products', 'public');
            $data['product_photo'] = $photo;
        }

        $product->update($data);
        Alert::success('Success', 'Success Edited');
        // Alert::toast('Success', 'Data Successfully Edited');
        return redirect()->to('products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        // delete photo from storage
        File::delete(public_path('storage/' . $product->product_photo));
        $product->delete();
        // $category = Categories::find($id);
        // $category->delete();

        Alert::success('Deleted', 'Deleted successfully');
        return redirect()->to('products');
    }
}

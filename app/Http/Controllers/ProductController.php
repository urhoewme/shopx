<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Products::paginate(9);
        return view('products.products', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'required|numeric',
            'image' => 'file|mimes:jpg,jpeg,png,gif|max:1024'
        ]);
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $fileName);
        $product = new Products();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $fileName;
        $product->save();
        return redirect('/products')->with('status', 'Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Products::query()->findOrFail($id);
        return view('products.product', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Products::query()->findOrFail($id);
        return view('products.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Products::query()->findOrFail($id);
        $image = $request->file;
        if($image)
        {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $data->image = $fileName;
        }
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->save();
        return view('products.products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

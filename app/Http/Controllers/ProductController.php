<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::paginate(9);
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
        $product = new Product();
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
        $data = Product::query()->findOrFail($id);
        $services = Service::all();
        return view('products.product', compact('data', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Product::query()->findOrFail($id);
        return view('products.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Product::query()->findOrFail($id);
        if($request->image != ''){
            $path = public_path('images');
            if($data->image != ''  && $data->image != null){
                $file_old = $path.'/'.$data->image;
                unlink($file_old);
            }
            $file = $request->image;
            $filename = time() . '.' . $request->image->extension();
            $file->move($path, $filename);
            $data->update(['image' => $filename]);
        }
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->save();
        return redirect('/products')->with('status', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        return redirect('/products')->with('status', 'Success');
    }
}

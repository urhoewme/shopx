<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        $productId = $request->input('product_id');
        $selectedServicesId = $request->input('services', []);
        $product = Product::find($productId);
        $selectedServices = Service::whereIn('id', $selectedServicesId)->get();
        $servicesTotalPrice = $selectedServices->sum('price');
        $totalPrice = $product->price + $servicesTotalPrice;

        $userId = auth()->user()->id;
        $cartItem = new CartItem();
        $cartItem->product_id = $productId;
        $cartItem->user_id = $userId;
        $cartItem->product_price = $product->price;
        $cartItem->additional_fees = $servicesTotalPrice;
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect('/products');
    }
}

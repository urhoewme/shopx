<?php

namespace App\Http\Controllers;

use App\Models\CartItemsServices;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $data = [];
        $id = \auth()->user()->id;
        $user = User::findOrFail($id);
        $carts = $user->cart()->get();
        $cartItems = $user->cartOwner()->get();
        $data['cartItems'] = $cartItems->toArray();
        return view('cart.cart', compact('data'));
    }



    public function addItem(Request $request)
    {
        if (\auth()->user()) {
            $user_id = \auth()->user()->id;
            $cart = Cart::updateOrCreate([
                'user_id' => $user_id,
            ], ['price' => 0]);
            $cartItem = new CartItem();
            $cartItem->product_id = $request->product_id;
            $product = Product::query()->findOrFail($request->product_id);
            $cartItem->quantity = $request->quantity;
            $cartItem->cart_id = $cart->id;
            $cartItem->save();


            if ($request->has('services')) {
                foreach ($request->services as $service_id) {
                    $service = Service::find($service_id);
                    if ($service) {
                        $cartItemService = new CartItemsServices();
                        $cartItemService->cart_item_id = $cartItem->id;
                        $cartItemService->service_id = $service_id;
                        $cartItemService->save();
                        $cart->price += $service->price * $request->quantity;
                    }
                }
            }
            $cart->price += Product::find($request->product_id)->price * $request->quantity;
            $cart->save();
            return redirect('/products');
        }
        return redirect('/login');
    }
}

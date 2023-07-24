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
        $info = [];
        $data = [];
        $id = \auth()->user()->id;
        $cart = Cart::all();
        foreach ($cart as $item) {
            if ($item->user_id == $id) {
                $cartItem = CartItem::where('cart_id', $item->id)->get();
                foreach ($cartItem as $item) {
                    $info = [
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                    ];
                    $product = Product::query()->findOrFail($info['product_id']);
                }
            }
        }
        return view('cart.cart')->with('data', $data);
    }


    public
    function addItem(Request $request)
    {
//        $user = User::find($request->user_id);
        if (\auth()->user()) {
            $user_id = \auth()->user()->id;
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->price = 0;
            $cart->save();

            $cartItem = new CartItem();
            $cartItem->product_id = $request->product_id;
            $cartItem->quantity = $request->quantity;
            $cartItem->cart_id = $cart->id;
            $cartItem->save();

            if ($request->has('services')) {
                foreach ($request->services as $service_id) {
                    $service = Service::find($service_id);
                    if ($service) {
                        $cartItemService = new CartItemsServices();
                        $cartItemService->cartItems_id = $cartItem->id;
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

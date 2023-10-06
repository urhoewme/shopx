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
        $request->validate([
            'quantity' => 'required|numeric',
        ]);
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

    public function clearCart()
    {
        $user_id = \auth()->user()->id;
        Cart::where('user_id', $user_id)->delete();
        return redirect('/cart')->with('status', 'Cart successfully cleared');
    }

    public function deleteCartItem(string $id)
    {
        CartItem::where('id', $id)->delete();
        return redirect('/cart')->with('status', 'Product has been deleted successfully');
    }

    public function deleteService(string $cart_item_id, string $service_id)
    {
        CartItemsServices::where([
            ['service_id', '=', $service_id],
            ['cart_item_id', '=', $cart_item_id],
        ])->delete();

        return redirect('/cart')->with('status', 'Service has been deleted');
    }

    public function increaseQuantity(Request $request, string $id)
    {
        $cartItem = CartItem::where('id', $id);
        $cartItem->quantity = $cartItem->quantity + 1;
        $cartItem->save();
        return view('/cart');
    }

    public function decreaseQuantity(Request $request, string $id)
    {
        $cartItem = CartItem::where('id', $id);
        $cartItem->quantity = $cartItem->quantity - 1;
        $cartItem->save();
        return view('/cart');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request)
    {
        if ($request->session()->has('shippingMethod')) {
            $shippingMethod = $request->session()->get('shippingMethod');
        } else {
            $shippingMethod = null;
        }

        return view('pages.cart', ['shippingMethod' => $shippingMethod]);
    }

    public function setShippingMethod(Request $request, $shippingMethod)
    {
        if (\Cart::getContent()->count() > 0) {
            $request->session()->put('shippingMethod', $shippingMethod);

            return response()->json([
                'error' => null,
                'message' => "Shipping method set to " . $shippingMethod,
            ]);
        } else {
            $request->session()->forget('shippingMethod');
            return response()->json([
                'error' => "Empty cart",
                'message' => "You can't set shipping method while cart is empty",
            ]);
        }
    }

    public function addToCart(Request $request)
    {
        $productId = $request->productId;

        $product = Product::findOrFail($productId);

        if ($request->has('productId')) {

            \Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'attributes' => ['unitPrice' => $product->price],
                'quantity' => 1,
            ]);

            return response()->json([
                'error' => null,
                'message' => ucfirst($product->name) . " added to cart",
                'productId' => $request->productId,
                "productName" => $product->name ?? null,
                "cartTotal" => \Cart::getTotal(),
                "cartItemsCount" => \Cart::getContent()->count(),
            ]);
        } else {
            return response()->json([
                'error' => 'Uknown product',
            ]);
        }
    }

    public function checkout(Request $request)
    {
        if ($request->session()->has('shippingMethod')) {
            $shippingMethod = $request->session()->get('shippingMethod');
        } else {
            $shippingMethod = null;
        }

        if (\Cart::getContent()->count() > 0) {
            return view('pages.deliveryinfo', ['shippingMethod' => $shippingMethod]);
        } else {
            return redirect()->route('public.shopping-cart', ['shippingMethod' => $shippingMethod]);
        }
    }

    public function clear(Request $request)
    {
        \Cart::clear();
        $request->session()->forget('shippingMethod');
        return redirect()->back();
    }
}

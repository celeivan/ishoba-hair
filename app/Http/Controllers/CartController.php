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

    public function addToCart(Request $request)
    {
        $productId = $request->productId;
        $product = Product::findOrFail($productId);
        $distributor = $request->distributor;
        $price = $product->price;
        $qty = 1;

        $distributorCondition = new \Darryldecode\Cart\CartCondition([
            'name' => 'Distributor Discount -R15',
            'type' => 'discount',
            'value' => '-15'
        ]);

        if($distributor == true){
            $qty = 10;
            $conditions = [$distributorCondition];
        }else{
            $conditions =[];
        }

        $message = "$qty ".ucfirst($product->name)." successfully added to cart";
        
        if ($request->has('productId')) {

            \Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'attributes' => ['unitPrice' => $product->price],
                'quantity' => $qty,
                'conditions' => $conditions,
            ]);

            return response()->json([
                'error' => null,
                'message' => $message,
                'productId' => $request->productId,
                "productName" => $product->name ?? null,
                "cartTotal" => \Cart::getTotal(),
                "cartItemsCount" => \Cart::getContent()->count(),
                'cartItems' => \Cart::getContent(),
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
}

<?php

namespace App\Http\Controllers;
use App\Product;
//use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }



    public function index()
    {
        return view('cart');
    }

    public function addToCart($itemID)
    {
          $product = Product::find($itemID);

          if(!$product) {

            abort(404);

          }

          $cart = session()->get('cart');

          // if cart is empty then this the first product
          if(!$cart) {

            $cart = [
                    $itemID => [
                        "id" => $product->id,
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image" => $product->image
                    ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

          }

          // if cart not empty then check if this product exist then increment quantity
          if(isset($cart[$itemID])) {

            $cart[$itemID]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

          }

          // if item not exist in cart then add to cart with quantity = 1
          $cart[$itemID] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
          ];

          session()->put('cart', $cart);

          return redirect()->back()->with('success', 'Product added to cart successfully!');

    }

    public function remove(Request $request)
    {
      if($request->id) {

          $cart = session()->get('cart');

          if(isset($cart[$request->id])) {

              unset($cart[$request->id]);

              session()->put('cart', $cart);
          }

          session()->flash('success', 'Product removed successfully');
      }
    }

}

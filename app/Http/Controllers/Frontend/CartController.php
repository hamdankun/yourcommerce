<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use Illuminate\Http\Request;
use App\Models\Master\Product;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Show Current Cart who stored on session
     * @return \Illuminate\Support\Response
     */
    public function index()
    {
      return response()->json($this->collection());
    }

    /**
     * Show spesific product on cart base on rowId
     * @param  string $rowId
     * @return \Illuminate\Support\Response
     */
    public function show($rowId)
    {
      return response()->json($this->collection($rowId));
    }

    /**
     * Store new product into cart and save to session
     * @return \Illuminate\Support\Response
     */
    public function store()
    {
      $product = $this->toCache('product-'.request()->input('slug'), function() {
        return Product::findBySlug(request()->input('slug'))->first();
      });
      Cart::add(['id' => $product->slug, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'options' => ['image' => $product->images->first()->path]]);
      return response()->json($this->collection());
    }

    /**
     * Update current product on the cart and save to session
     * @return \Illuminate\Support\Response
     */
    public function update($rowId)
    {
      Cart::update($rowId, valid_number(request()->input('qty')));
      return response()->json($this->collection($rowId));
    }

    /**
     * delete current product into cart
     * @return \Illuminate\Support\Response
     */
    public function destroy($rowId)
    {
      Cart::remove($rowId);
      return response()->json($this->collection());
    }

    /**
     * Current cart who already store on session
     * @return [type] [description]
     */
    public function collection($rowId = '')
    {
      return [
        // 'count' => Cart::count(),
        'count' => Cart::content()->count(),
        'sub_total' => Cart::subtotal(),
        'taxt' => Cart::tax(),
        'total' => Cart::total(),
        'data' => $rowId ? Cart::get($rowId) : Cart::content()
      ];
    }
}

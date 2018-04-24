<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 4/21/2018
 * Time: 7:22 PM
 */

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController {
    protected $cart = null;
    public function __construct(CartRepository $repository) {
        $this->cart = $repository;
    }

    public function index(Request $request) {
        return View('cart.index');
    }
    public function store(Request $request, Product $product) {
        $this->cart->add($product);
        return Redirect::to(route('products.index'))->with(['message' => 'Item successfully added to cart']);
    }
    public function remove(Request $request, $item) {
        $this->cart->remove($item);
        return View('cart.index')->with(["message" => "Item was removed"]);
    }
    public function checkout(Request $request) {
        $this->cart->checkout($request->input('name'), $request->input('contactDetails'), $request->input('comments'));
        return Redirect::to(route('products.index'))->with(['message' => 'Your order has been placed']);
    }
}
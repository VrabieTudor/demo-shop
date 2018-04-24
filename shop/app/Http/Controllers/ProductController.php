<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\DestroyProductRequest;
use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller {
    protected $product = null;
    public function __construct(ProductRepository $repository) {
        $this->product = $repository;
    }

    public function index(IndexProductRequest $request) {
        $products = $this->product->getAllProducts($request->input('page'));
        return View('product.index', compact('products'));
    }
    public function create() {
        return View('product.product');
    }
    public function store(StoreProductRequest $request) {
        $this->product->create(
            $request->input('title'),
            $request->input('description'),
            $request->input('price'),
            $request->file
        );
        return Redirect::to(route('products.index'))->with(['message' => 'Item successfully added']);
    }
    public function show() {

    }
    public function edit(Request $request, Product $product) {
        return View('product.product', compact('product'));
    }
    public function update(UpdateProductRequest $request, Product $product) {
        $this->product->update(
            $product->id,
            $request->input('title'),
            $request->input('description'),
            $request->input('price'),
            $request->file
        );
        return Redirect::to(route('products.index'))->with(['message' => 'Item successfully updated']);
    }
    public function destroy(DestroyProductRequest $request, Product $product) {
        $this->product->delete($product->id);
        return Redirect::to(route('products.index'))->with(['message' => 'Item successfully Deleted']);
    }
}

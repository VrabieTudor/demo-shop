<?php

namespace App\Repositories;

use App\Product;
use App\User;
use Carbon\Carbon;

class ProductRepository {
    public function getAllProducts($page = null) {
        return Product::orderBy('title', 'asc')->simplePaginate(3);
    }
    public function create($title, $description, $price, $file) {
        $newFileName = null;
        if($file) {
            $newFileName =
                str_random(3) . '_' .
                Carbon::now(config('app.timezone'))->getTimestamp() . "." .
                $file->getClientOriginalExtension();

            $fullPath = public_path($newFileName);
            $file->storeAs('/public', $newFileName);

        }
        return Product::create([
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'file_path' => $newFileName
        ]);
    }
    public function update($id, $title, $description, $price, $file) {
        $product = Product::find($id);
        $fileName = $product->file_path;
        if($file) {
            $fileName =
                str_random(3) . '_' .
                Carbon::now(config('app.timezone'))->getTimestamp() . "." .
                $file->getClientOriginalExtension();

            $fullPath = public_path($fileName);
            $file->storeAs('/public', $fileName);
        }
        return $product->update([
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'file_path' => $fileName
            ]);
    }
    public function delete($id) {
        return Product::find($id)->delete();
    }
}
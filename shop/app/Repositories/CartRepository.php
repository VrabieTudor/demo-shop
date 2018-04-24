<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 4/21/2018
 * Time: 7:52 PM
 */

namespace App\Repositories;


use App\Mail\Checkout;
use App\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartRepository {
 public function add(Product $product) {
     if(Session::has('cart')) {
         $cart = Session::get('cart');
         if(isset($cart[$product->id])) {
             $cart[$product->id]['quantity'] += 1;
         } else {
             $cart[$product->id] = ['product' => $product, 'quantity' => 1];
         }
         $cart['total'] += $product->price;
     } else {
         $cart[$product->id] = ['product' => $product, 'quantity' => 1];
         $cart['total'] = $product->price;
     }
     Session::put('cart', $cart);
 }
 public function remove($item) {
    if(Session::has('cart')) {
        $cart = Session::get('cart');
        if(isset($cart[$item])) {
            if($cart[$item]['quantity'] > 1) {
                $cart[$item]['quantity'] -= 1;
                $cart['total'] -= $cart[$item]['product']['price'];
            } else {
                $cart['total'] -= $cart[$item]['product']['price'];
                unset($cart[$item]);
            }
        }
        Session::put('cart', $cart);
    }
 }
 public function checkout($name, $contactDetails, $comments) {
     $viewData = [
         'name' => $name,
         'contactDetails' => $contactDetails,
         'comments' => $comments,
         'cart' => Session::get('cart')
     ];
     Mail::send('emails.checkout', $viewData, function ($message) {
         $message->from(config('mailconfig')['mailFrom'], 'Shop Demo');
         $message->subject('Order confirmation');
         $message->to(config('mailconfig')['mailTo']);
     });
     Session::forget('cart');
 }
}
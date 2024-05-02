<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Gloudemans\Shoppingcart\Facades\Cart;



class CartController extends Controller
{
 public function save_cart(Request $request){
    $productId = $request->productid_hidden;
    $quantity = $request->qty;
    $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
    $data['id'] = $product_info->product_id;
    $data['qty'] = $quantity;
    $data['name'] = $product_info->product_name;
    $data['price'] = $product_info->product_price;
    $data['weight'] = '123';
    $data['options']['image'] = $product_info->product_image;
    Cart::add($data);
    Cart::setGlobalTax(10);
    return Redirect::to('/show-cart');
 }
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category', $cate_product);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity($rowId, $qty){
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}

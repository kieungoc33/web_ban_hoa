<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Slider;
use App\Models\CategoryPostModel;



class CartController extends Controller
{
 
    /*public function gio_hang(Request $request){
        //seo 
        //slide
       $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();

       $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
       //--seo
       $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
      
       return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('slider',$slider)->with('category_post',$category_post);
   }
   public function add_cart_ajax(Request $request){
    // Session::forget('cart');
    $data = $request->all();
    $session_id = substr(md5(microtime()),rand(0,26),5);
    $cart = Session::get('cart');
    if($cart==true){
        $is_avaiable = 0;
        foreach($cart as $key => $val){
            if($val['product_id']==$data['cart_product_id']){
                $is_avaiable++;
            }
        }
        if($is_avaiable == 0){
            $cart[] = array(
            'session_id' => $session_id,
            'product_name' => $data['cart_product_name'],
            'product_id' => $data['cart_product_id'],
            'product_image' => $data['cart_product_image'],
           // 'product_quantity' => $data['cart_product_quantity'],
            'product_qty' => $data['cart_product_qty'],
            'product_price' => $data['cart_product_price'],
            );
            Session::put('cart',$cart);
        }
    }else{
        $cart[] = array(
            'session_id' => $session_id,
            'product_name' => $data['cart_product_name'],
            'product_id' => $data['cart_product_id'],
            'product_image' => $data['cart_product_image'],
           // 'product_quantity' => $data['cart_product_quantity'],
            'product_qty' => $data['cart_product_qty'],
            'product_price' => $data['cart_product_price'],

        );
        Session::put('cart',$cart);
    }
   
    Session::save();

}   
*/


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
        $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('slider', $slider)->with('category_post', $category_post);
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

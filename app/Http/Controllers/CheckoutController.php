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
class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(){
        $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('slider', $slider)->with('category_post', $category_post);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_cusstomers')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout(){
        $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('slider', $slider)->with('category_post', $category_post);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_note'] = $request->shipping_note;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(){
        $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        return view('pages.checkout.payment')->with('category', $cate_product)->with('slider', $slider)->with('category_post', $category_post);

       
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_cusstomers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        }else{
            return Redirect::to('/login-checkout');
        }

    }
    public function order_place(Request $request){
        //insert payment_method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert order_detail
        $content = Cart::content();
        foreach($content as $v_content){
            $order_detail_data = array();
            $order_detail_data['order_id'] = $order_id;
            $order_detail_data['product_id'] = $v_content->id;
            $order_detail_data['product_name'] = $v_content->name;
            $order_detail_data['product_price'] = $v_content->price;
            $order_detail_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_detail_data);
        }
        if($data['payment_method'] == 1){
            echo 'Thanh toán bằng thẻ ATM';
        }elseif($data['payment_method'] == 2){
            Cart::destroy();
            $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();

            $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
            $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
            return view('pages.checkout.handcash')->with('category', $cate_product)->with('slider', $slider)->with('category_post', $category_post);
        }else{
            echo 'Thanh toán bằng thẻ ghi nợ';
        }
    }
    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_cusstomers', 'tbl_order.customer_id', '=', 'tbl_cusstomers.customer_id')
        ->select('tbl_order.*', 'tbl_cusstomers.customer_name')
        ->orderby('tbl_order.order_id', 'desc')->get();
        $manage_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manage_order);
    }
    public function view_order($orderId)
{
    $this->AuthLogin();
    
    $order_by_id = DB::table('tbl_order')
    ->join('tbl_cusstomers', 'tbl_order.customer_id', '=', 'tbl_cusstomers.customer_id')
    ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
    ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
    ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
    ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
    ->where('tbl_order.order_id', $orderId)
    ->select('tbl_order.*', 'tbl_cusstomers.*', 'tbl_shipping.*', 'tbl_order_details.*', 'tbl_payment.*', 'tbl_product.product_name', 'tbl_product.product_price')
    ->distinct() // Sử dụng distinct
    ->get();

    $view_order = view('admin.view_order')->with('order_by_id', $order_by_id);
    return view('admin_layout')->with('admin.view_order', $view_order);
}
public function delete_order($orderId)
{
    $this->AuthLogin();
    DB::table('tbl_order')->where('order_id', $orderId)->delete();
    Session::put('message', 'Xóa đơn hàng thành công');
    return Redirect::to('manage-order');

}
}

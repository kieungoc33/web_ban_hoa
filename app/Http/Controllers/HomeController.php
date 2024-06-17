<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Models\Slider;  
use App\Models\CategoryPostModel;

class HomeController extends Controller
{
  public function index()
  {
    
    //category post
    $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();

    $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
    $all_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id', 'desc')->limit(12)->get();
    return view('pages.home')->with('category', $cate_product)->with('all_product', $all_product)->with('slider', $slider)->with('category_post', $category_post);
}
public function search(Request $request)
{
    $category_post = CategoryPostModel::orderBy('cate_post_id','DESC')->get();
    $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    $keywords = $request->keywords_submit;
    $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
    $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();
    return view('pages.product.search')->with('category', $cate_product)-> with('search_product', $search_product)->with('slider', $slider)->with('category_post', $category_post);
}
public function send_mail(){
    $to_name = "kieu quang747";
    $to_email = "kieuquang747@gmail.com";
    $data = array("name"=>"Mail từ flowershop", "body" => "vui lòng xác nhận đơn hàng của bạn");
    Mail::send('pages.send_mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject("Mail từ flowershop");
        $message->from($to_email, $to_name);
    });
    Return redirect('/')->with('message', 'Gửi mail thành công');
}
}

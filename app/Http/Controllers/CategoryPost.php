<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryPostModel;


class CategoryPost extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_post(){
        $this->Authlogin();
        return view('admin.category_post.add_category');
    }
    public function save_category_post(Request $request){
        $this-> Authlogin();
        $data= request()->all();
        $category_post = new CategoryPostModel();
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->save();
        Session::put('message','Thêm danh mục bài viết thành công');
        return redirect()->back();

    }
    public function all_category_post(){
        $this->Authlogin();
        $category_post = CategoryPostModel::orderBy('cate_post_id','desc')->paginate(5);
        return view('admin.category_post.list_category')->with(compact('category_post'));
    }
    public function edit_category_post($category_post_id){
        $this->Authlogin();
        $edit_category_post = CategoryPostModel::where('cate_post_id',$category_post_id)->get();
        return view('admin.category_post.edit_category')->with(compact('edit_category_post'));
    }
    public function danh_muc_bai_viet($category_post_slug){
       
    }
}
@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" data-validation="length" data-validation-length="max100" data-validation-error-msg="điền tên sản phẩm" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" required>
                            </div>  
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="điền số tiền" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group"></div>
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8"
                             type="password" class="form-control" name = "product_desc" id="ckeditor1" placeholder="Mô tả danh mục" required></textarea>

                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8"
                             type="password" class="form-control" name = "product_content" id="ckeditor" placeholder="Mô tả danh mục" required></textarea>
                        </div>
                        <div class="form-group"></div>
                            <label for="exampleInputFile">Danh mục sản phẩm</label>
                            <select name ="product_cate"class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name ="product_status"class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value ="1">Hiện</option>
                            </select>
                        </div>
                        
                        <button type="submit" name ="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection

                           
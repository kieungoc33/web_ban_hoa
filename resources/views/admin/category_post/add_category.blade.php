@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục bài viết
                </header>
                <div class="panel-body">
                    <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class = "text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-category-post')}}" method="post">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="text" name="cate_post_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" onkeyup = "ChangToSlug()" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <textarea style="resize: none" rows="8"
                             type="password" class="form-control" name = "cate_post_slug" id="exampleInputPassword1" placeholder="Slug" required></textarea>
                        </div>
                            
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="8"
                             type="password" class="form-control" name = "cate_post_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục" required></textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name ="cate_post_status"class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value ="1">Hiện</option>
                            </select>
                        </div>
                        
                        <button type="submit" name ="add_post_cate" class="btn btn-info">Thêm danh mục bài viết</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection

                           
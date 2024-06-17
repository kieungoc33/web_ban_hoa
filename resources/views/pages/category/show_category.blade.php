@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
    @foreach($category_name as $key => $name)
    
    <h2 class="title text-center">{{$name->category_name}}</h2>
    @endforeach

    @foreach($category_by_id as $key => $product)
    <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('uploads/product/'.$product->product_image)}}" alt="" style="width: 300px; height: 200px;" />
                    <h2>{{number_format($product->product_price).' '.'VND'}}</h2>
                    <p>{{$product->product_name}}</p>
                    <form action="{{URL::to('/save-cart')}}" method="POST">
                        @csrf
                        <input type="hidden" name="productid_hidden" value="{{$product->product_id}}">
                        <input type="hidden" name="product_name" value="{{$product->product_name}}">
                        <input type="hidden" name="product_image" value="{{$product->product_image}}">
                        <input type="hidden" name="product_price" value="{{$product->product_price}}">
                        <input type="hidden" name="qty" value="1">
                        <button type="submit" class="btn btn-default add-to-cart">
                            <i class="fa fa-shopping-cart"></i> Thanh toán
                        </button>
                    </form>
                </div>                
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Thêm yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    
</div><!--features_items-->
@endsection


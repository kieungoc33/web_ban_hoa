@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description" style="text-align: center;">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('uploads/product/'.$v_content->options->image)}}" alt="" style="height: 100px; width: 100px;"></a>
                        </td>
                        <td class="cart_description" style="text-align: center;">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                        </td>
                        
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).' '.'VND'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href="{{URL::to('/update-cart-quantity/'.$v_content->rowId.'/'.($v_content->qty + 1))}}"> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href="{{URL::to('/update-cart-quantity/'.$v_content->rowId.'/'.($v_content->qty - 1))}}"> - </a>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $v_content->price * $v_content->qty;
                                    echo number_format($subtotal).' '.'VND';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4 style="margin-bottom: 30px;">Chọn hình thức thanh toán</h4>
        <form action="{{URL::to('/order-place')}}" method="POST">
            {{ csrf_field() }}
            <div class="payment-options">
                <span>
                    <label><input name= "payment_option" value="1" type="checkbox"> Thanh toán bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option"  value="2" type="checkbox"> Thanh toán khi nhận hàng</label>
                </span>
                <span>
                    <label><input name="payment_option" value="3" type="checkbox"> Thanh toán bằng thẻ ghi nợ</label>
                </span>
                <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
            </div>
           
        </form>
    </div>
</section> <!--/#cart_items-->

@endsection
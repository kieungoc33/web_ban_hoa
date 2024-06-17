<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Shop hoa tươi KN</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="frontend/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="frontend/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="frontend/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="frontend/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="frontend/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="frontend/images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>

								<?php
								$customer_id = Session::get('customer_id');
								$shipping_id = Session::get('shipping_id');
								if($customer_id!=NULL && $shipping_id==NULL){
								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								}elseif($customer_id!=NULL && $shipping_id!=NULL){
								?>
								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
								}
								?>
								
								<li>
									<a href="{{ URL::to('/show-cart') }}">
										<i class="fa fa-shopping-cart"></i> 
										Giỏ hàng 
										@php
											$cartCount = Cart::count();
										@endphp
										@if($cartCount > 0)
											<span class="badge">{{ $cartCount }}</span>
										@endif
									</a>
								</li>
								
								
								<?php
								$customer_id = Session::get('customer_id');
								if($customer_id!=NULL){
								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php
								}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li class="dropdown">
									<a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										@foreach($category_post as $key => $cate)
										<li><a href="{{URL::to('/danh-muc-bai-viet/'.$cate->cate_post_slug)}}">{{$cate->cate_post_name}}</a></li>
										@endforeach

									</ul>
                                    
                                </li> 
								<li><a href="{{URL::to('/show-cart')}}">Giỏ hàng <span class="cart-quantity">(</span><span class="cart-quantity-number" style="color: red;">{{ Cart::count() }}</span><span class="cart-quantity">)</span></a></li>


								<li><a href="contact-us.html">Liên hệ</a></li>
								
								
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							{{csrf_field()}}
						<div class="search_box pull-right">
							<input type="text" name ="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
							<input type="submit" style="margin-top: 0" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm"/>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						<style type="text/css">
                            img.img.img-responsive.img-slider {
                                height: 350px;
                            }
                        </style>
						<div id="slider-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
							<div class="carousel-inner">
								@php 
									$i = 0;
								@endphp
								@foreach($slider as $key => $slide)
									@php 
										$i++;
									@endphp
									<div class="item {{$i==1 ? 'active' : '' }}">
										
										<div class="col-sm-12">
											<img alt="{{$slide->slider_desc}}" src="{{asset('uploads/slider/'.$slide->slider_image)}}" height="200" width="100%" class="img img-responsive img-slider">
											
										</div>
									</div>
								@endforeach  
						 </div>
						
							<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
						
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
						</div><!--/category-products-->
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					@yield('content')

					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
        <script src="{{asset('frontend/js/jquery.js')}}"></script>
        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('frontend/js/price-range.js')}}"></script>
        <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('frontend/js/main.js')}}"></script>
		<script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>



		{{--<script type="text/javascript">
			$(document).ready(function(){
				$('.add-to-cart').click(function(){
	
					var id = $(this).data('id_product');
					// alert(id);
					var cart_product_id = $('.cart_product_id_' + id).val();
					var cart_product_name = $('.cart_product_name_' + id).val();
					var cart_product_image = $('.cart_product_image_' + id).val();
					//var cart_product_quantity = $('.cart_product_quantity_' + id).val();
					var cart_product_price = $('.cart_product_price_' + id).val();
					var cart_product_qty = $('.cart_product_qty_' + id).val();
					var _token = $('input[name="_token"]').val();
					//if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
						//alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
					//}else{
	
						$.ajax({
							url: '{{url('/add-cart-ajax')}}',
							method: 'POST',
							data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
							success:function(){
	
								swal({
										title: "Đã thêm sản phẩm vào giỏ hàng",
										text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
										showCancelButton: true,
										cancelButtonText: "Xem tiếp",
										confirmButtonClass: "btn-success",
										confirmButtonText: "Đi đến giỏ hàng",
										closeOnConfirm: false
									},
									function() {
										window.location.href = "{{url('/gio-hang')}}";
									});
	
							}
	
						});
					//}
	
					
				});
			});
		</script>
		--}}
</body>
</html>
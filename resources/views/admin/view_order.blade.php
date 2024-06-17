@extends('admin_layout')
@section('admin_content')

<!-- Thông tin khách hàng -->
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">Thông tin khách hàng</div>
        <div class="table-responsive">
            @if ($message = Session::get('message'))
                <span class="text-alert">{{ $message }}</span>
                {{ Session::put('message', null) }}
            @endif
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $displayed_customers = [];
                    @endphp
                    @foreach ($order_by_id as $order)
                        @if (isset($order->customer_name) && isset($order->customer_phone) && !in_array($order->customer_name, $displayed_customers))
                            <tr>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                            </tr>
                            @php
                                $displayed_customers[] = $order->customer_name;
                            @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Thông tin vận chuyển -->
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">Thông tin vận chuyển</div>
        <div class="table-responsive">
            @if ($message = Session::get('message'))
                <span class="text-alert">{{ $message }}</span>
                {{ Session::put('message', null) }}
            @endif
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên người vận chuyển</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $displayed_shipping = [];
                    @endphp
                    @foreach ($order_by_id as $order)
                        @if (isset($order->shipping_name) && isset($order->shipping_address) && isset($order->shipping_phone) && !in_array($order->shipping_name, $displayed_shipping))
                            <tr>
                                <td>{{ $order->shipping_name }}</td>
                                <td>{{ $order->shipping_address }}</td>
                                <td>{{ $order->shipping_phone }}</td>
                            </tr>
                            @php
                                $displayed_shipping[] = $order->shipping_name;
                            @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Liệt kê chi tiết đơn hàng -->
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">Liệt kê chi tiết đơn hàng</div>
        <div class="table-responsive">
            @if ($message = Session::get('message'))
                <span class="text-alert">{{ $message }}</span>
                {{ Session::put('message', null) }}
            @endif
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_by_id as $order)
                        @if (isset($order->product_name) && isset($order->product_sales_quantity) && isset($order->product_price))
                            <tr>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->product_sales_quantity }}</td>
                                <td>{{ number_format($order->product_price, 0, ',', '.') }} VND</td>
                                <td>{{ number_format($order->product_sales_quantity * $order->product_price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

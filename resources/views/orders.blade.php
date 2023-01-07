@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Orders') }} 
            <span style="float:right">
            <label style="font-weight:bold">Total Sales:</label> ${{$totalOrderSales}}&nbsp
            <label style="font-weight:bold">Average Sales:</label> ${{$averageOrderSales}}</span>
        </div>
        <div class="card-body">
            <div class="filters">
                <form action="/orders">
                    <label>Product Filter</label>:&nbsp
                    <input type="text" name="filters[product_name]" value="@if(!empty($filters['product_name'])){{$filters['product_name']}}@endif">&nbsp
                    <label>SKU Filter</label>:&nbsp
                    <input type="text" name="filters[sku]" value="@if(!empty($filters['sku'])){{$filters['sku']}}@endif">&nbsp
                    <input type="submit" name="submit" value="submit">
                </form>
            </div>
            @include('nav')
            <table class="table table-bordered">
                <theader>
                    <th style="color:white;background-color:blue">Customer</th>
                    <th style="color:white;background-color:blue">Email</th> 
                    <th style="color:white;background-color:blue">Product</th>
                    <th style="color:white;background-color:blue">Color</th>
                    <th style="color:white;background-color:blue">Size</th>
                    <th style="color:white;background-color:blue">Order Status</th>
                    <th style="color:white;background-color:blue">Order Total</th>
                    <th style="color:white;background-color:blue">Transaction ID</th>
                    <th style="color:white;background-color:blue">Shipper</th>
                    <th style="color:white;background-color:blue">Tracking Number</th> 
                </theader>              
                <tbody>
                @foreach($orders as $order)     
                    <tr>           
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->product_name}}</td>
                        <td>{{$order->color}}</td>
                        <td>{{$order->size}}</td>
                        <td>{{$order->order_status}}</td>
                        <td>${{number_format($order->total_cents/100.00, 2)}}</td>                        
                        <td>{{$order->transaction_id}}</td>
                        <td>{{$order->shipper_name}}</td>
                        <td>{{$order->tracking_number}}</td>                
                    </tr>
                @endforeach 
                </tbody>   
            </table>
            @include('nav')
        </div>
    </div>
</div>
@endsection
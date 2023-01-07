@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Inventory') }} 
            <span style="float:right">
            <label style="font-weight:bold">Total Inventory Items:</label> {{$inventoryCount}}&nbsp
        </div>
        <div class="card-body">
            <div class="filters">
                <form action="/inventory">
                    <label>Product ID Filter</label>:&nbsp
                    <input type="text" name="filters[product_id]" value="@if(!empty($filters['product_id'])){{$filters['product_id']}}@endif">&nbsp
                    <input type="submit" name="submit" value="submit">
                </form>
            </div>
            @include('nav')
            <table class="table table-bordered">
                <theader>
                    <th style="color:white;background-color:blue">Prodyct Name</th>
                    <th style="color:white;background-color:blue">SKU</th> 
                    <th style="color:white;background-color:blue">Quantity</th>
                    <th style="color:white;background-color:blue">Color</th>
                    <th style="color:white;background-color:blue">Size</th>
                    <th style="color:white;background-color:blue">Price</th>
                    <th style="color:white;background-color:blue">Cost</th>
                </theader>              
                <tbody>
                @foreach($inventoryList as $inventory)     
                    <tr>           
                        <td>{{$inventory->product_name}}</td>
                        <td>{{$inventory->sku}}</td>
                        <td>{{$inventory->quantity}}</td>
                        <td>{{$inventory->color}}</td>
                        <td>{{$inventory->size}}</td>
                        <td>${{number_format($inventory->price_cents/100.00, 2)}}</td>
                        <td>${{number_format($inventory->cost_cents/100.00, 2)}}</td>              
                    </tr>
                @endforeach 
                </tbody>   
            </table>
            @include('nav')
        </div>
    </div>
</div>
@endsection
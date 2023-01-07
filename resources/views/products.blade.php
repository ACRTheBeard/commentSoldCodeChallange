@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @include('nav')
            <table class="table table-bordered">
                <theader>
                    <th style="color:white;background-color:blue">Name</th>
                    <th style="color:white;background-color:blue">Style</th> 
                    <th style="color:white;background-color:blue">Brand</th>
                    <th style="color:white;background-color:blue">SKUs</th>
                </theader>              
                <tbody>
                @foreach($products as $product)     
                    <tr>           
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->style}}</td>
                        <td>{{$product->brand}}</td>
                        <td>{{$product->skus}}</td>              
                    </tr>
                @endforeach 
                </tbody>   
            </table>
            @include('nav')
        </div>
    </div>
</div>
@endsection
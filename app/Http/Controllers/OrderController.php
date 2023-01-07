<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Orders landing page controller
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        $page = $request->get('page');
        if (empty($page)) {
            $page = 1;
        }

        $user = auth()->user();
        $limit = 20;
        $orders = DB::table('orders as o')
            ->selectRaw('o.name, o.email, p.product_name, i.color, i.size,
            o.order_status, o.total_cents, o.transaction_id, o.shipper_name, o.tracking_number')
            ->join('products as p', 'p.id', 'o.product_id')
            ->join('inventory  as i', 'i.id', 'o.inventory_id')
            ->where('p.admin_id', $user->id)
            ->limit($limit)
            ->offset($limit*$page)
            ->get();

        $orderSums = DB::table('orders as o')
            ->selectRaw('count(*) as total_orders, SUM(o.total_cents)/100.00 as total_order_sales, (SUM(o.total_cents)/count(*))/100.00 average_order_sales')
            ->join('products as p', 'p.id', 'o.product_id')
            ->join('inventory  as i', 'i.id', 'o.inventory_id')
            ->where('p.admin_id', $user->id)
            ->first();

        $lastPage = intVal($orderSums->total_orders/20);

        $view = view('orders')->with([
            'orders'=>$orders,
            'nextPage'=>$page>=$lastPage?false:$page+1,
            'previousPage'=>$page<=1?false:$page-1,
            'totalOrderSales'=>number_format($orderSums->total_order_sales,2),
            'averageOrderSales'=>number_format($orderSums->average_order_sales,2),
        ] );        
        return $view;        
    }
}

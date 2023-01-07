<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Services\OrderService;

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
            $page = 0;
        }

        $filters = $request->get('filters');
        if (empty($filters)) {
            $filters = [];
        }

        $filterString = '';
        $first = true;
        foreach ($filters as $index=>$value) {            
            if (!$first) {
                $filterString .= '&';
            } else {
                $first = false;
            }
            $filterString .= 'filters[' . $index . ']=' . $value;
        }

        $user = auth()->user();
        $limit = 20;
        
        $orders = app(OrderService::class)->getUserOrders($user->id, $limit, $page, $filters);
        $orderSums = app(OrderService::class)->getUserOrderSums($user->id, $filters);

        

        $nav = [];
        if ($orderSums->total_orders > $limit) { 
            $lastPage = intVal($orderSums->total_orders/$limit);       
            $nav = [                
                'path'=>'\orders',
                'nextPage'=>$page>=$lastPage?false:$page+1,
                'previousPage'=>$page<=0?false:$page-1,
                'page'=>$page,
                'lastPage'=>$lastPage,
            ];
        }

        $view = view('orders')->with([
            'orders'=>$orders,
            'nav'=>$nav,
            'filters'=>$filters,
            'filterString'=>$filterString,
            'totalOrderSales'=>number_format($orderSums->total_order_sales,2),
            'averageOrderSales'=>number_format($orderSums->average_order_sales,2),
        ] );        
        return $view;        
    }
}

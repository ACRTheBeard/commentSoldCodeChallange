<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
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

        $user = auth()->user();
        $limit = 20;
        
        $products = app(ProductService::class)->getUserProducts($user->id, $limit, $page);
        $productSums = app(ProductService::class)->getUserProductSums($user->id);        

        $nav = [];
        if ($productSums->total_products> $limit) { 
            $lastPage = intVal($productSums->total_products/$limit);       
            $nav = [
                'path'=>'\products',
                'nextPage'=>$page>=$lastPage?false:$page+1,
                'previousPage'=>$page<=0?false:$page-1,
                'page'=>$page,
                'lastPage'=>$lastPage,
            ];
        }

        $view = view('products')->with([
            'products'=>$products,
            'nav'=>$nav,
            'filterString'=>''
        ]);
        return $view;        
    }
}

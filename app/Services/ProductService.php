<?php

namespace App\Services;

use App\Models\Orders;

use Illuminate\Support\Facades\DB;

Class ProductService {

    /**
     * @param Integer $userId 
     * @param Integer $limit
     * @param Integer $page
     * @return Collection $orders
     */
    public function getUserProducts($userId,$limit,$page) {        
        $query = DB::table('products as p')
            ->selectRaw('p.product_name, p.style, p.brand, GROUP_CONCAT(i.sku) as skus')
            ->leftJoin('inventory as i', 'i.product_id', 'p.id')
            ->where('p.admin_id', $userId)
            ->orderBy('p.product_name')
            ->groupBy('p.product_name', 'p.style', 'p.brand')
            ->limit($limit)
            ->offset($limit*$page);
        
        return $query->get();
    }

    /**
     * @param Integer $userId 
     * @return Collection $orderSums
     */
    public function getUserProductSums($userId) {
        $query = DB::table('products as p')
            ->selectRaw('count(*) as total_products')
            ->where('p.admin_id', $userId);
        
        return $query->first();
    }
}
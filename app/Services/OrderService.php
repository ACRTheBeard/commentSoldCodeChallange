<?php

namespace App\Services;

use App\Models\Orders;

use Illuminate\Support\Facades\DB;

Class OrderService {

    /**
     * @param Integer $userId 
     * @param Integer $limit
     * @param Integer $page
     * @param array $filters
     * @return Collection $orders
     */
    public function getUserOrders($userId,$limit,$page,$filters) {        
        $query = DB::table('orders as o')
            ->selectRaw('o.name, o.email, p.product_name, i.color, i.size,
            o.order_status, o.total_cents, o.transaction_id, o.shipper_name, o.tracking_number')
            ->join('products as p', 'p.id', 'o.product_id')
            ->join('inventory  as i', 'i.id', 'o.inventory_id')
            ->where('p.admin_id', $userId)
            ->limit($limit)
            ->offset($limit*$page);

        $query = $this->addFilters($query, $filters);
        
        return $query->get();
    }

    /**
     * @param Integer $userId 
     * @param array $filters
     * @return Collection $orderSums
     */
    public function getUserOrderSums($userId, $filters) {
        $query = DB::table('orders as o')
            ->selectRaw('count(*) as total_orders, SUM(o.total_cents)/100.00 as total_order_sales, (SUM(o.total_cents)/count(*))/100.00 average_order_sales')
            ->join('products as p', 'p.id', 'o.product_id')
            ->join('inventory  as i', 'i.id', 'o.inventory_id')
            ->where('p.admin_id', $userId);

        $query = $this->addFilters($query, $filters);
        
        return $query->first();
    }

    private function addFilters ($query, $filters) {
        if(!empty($filters['product_name'])) {
            $query->where('p.product_name', 'like', '%' . $filters['product_name'] . '%');
        }

        if(!empty($filters['sku'])) {
            $query->where('i.sku', 'like', '%' . $filters['sku'] . '%');
        }

        return $query;
    }
}
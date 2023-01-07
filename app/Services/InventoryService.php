<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

Class InventoryService {

    /**
     * @param Integer $userId 
     * @param Integer $limit
     * @param Integer $page
     * @param array $filters
     * @return Collection $orders
     */
    public function getUserInventory($userId,$limit,$page,$filters) {        
        $query = DB::table('inventory as i')
            ->selectRaw('p.product_name, i.sku, i.quantity, i.color, i.size, i.price_cents, i.cost_cents')
            ->join('products as p', 'p.id', 'i.product_id')
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
    public function getUserInventoryNavCount($userId, $filters) {
        $query = DB::table('inventory as i')
            ->selectRaw('count(*) as total')
            ->join('products as p', 'p.id', 'i.product_id')
            ->where('p.admin_id', $userId);     
        
        $query = $this->addFilters($query, $filters);
            
        return $query->first();
    }

    /**
     * @param Integer $userId 
     * @return Collection $orderSums
     */
    public function getUserInventoryCount($userId) {
        $query = DB::table('inventory as i')
            ->selectRaw('count(*) as total')
            ->join('products as p', 'p.id', 'i.product_id')
            ->where('p.admin_id', $userId);       
            
        return $query->first();
    }

    private function addFilters ($query, $filters) {
        if(!empty($filters['product_id'])) {
            $query->where('p.id', $filters['product_id']);
        }

        return $query;
    }
}
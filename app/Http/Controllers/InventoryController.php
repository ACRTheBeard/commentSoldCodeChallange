<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Services\InventoryService;

class InventoryController extends Controller
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
        
        $inventoryList = app(InventoryService::class)->getUserInventory($user->id, $limit, $page, $filters);
        $inventoryNavCount = app(InventoryService::class)->getUserInventoryNavCount($user->id, $filters);
        $inventoryCount = app(InventoryService::class)->getUserInventoryCount($user->id);
         
        $nav = [];
        if ($inventoryNavCount->total > $limit) {
            $lastPage = intVal($inventoryNavCount->total/$limit);       
            $nav = [                
                'path'=>'\inventory',
                'nextPage'=>$page>=$lastPage?false:$page+1,
                'previousPage'=>$page<=0?false:$page-1,
                'page'=>$page,
                'lastPage'=>$lastPage,
            ];
        }

        $view = view('inventory')->with([
            'inventoryList'=>$inventoryList,
            'nav'=>$nav,
            'filters'=>$filters,
            'filterString'=>$filterString,
            'inventoryCount'=>$inventoryCount->total,
        ] );        
        return $view;        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function getOrders() {
       
        $rawData = file_get_contents(__DIR__ . '/../../../data/orders.csv');
        
        // convert to array 
        $rows = explode("\n", $rawData);
        
        $headerData;
        $orderData;

        foreach($rows as $index => $row) {
            if ($index == 0) {
                continue;
            }

            $rowArray = explode(',',$row);
            dd($rowArray);
            $ordersData[] = new Order($rowArray);
        }
        return $ordersData;
    }
}

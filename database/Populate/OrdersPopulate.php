<?php

namespace Database\Populate;

use App\Models\Order;

class OrdersPopulate
{
    public static function populate()
    {
        $data =  [
            'client_table_id' => 1,
            'status' => 'open',
        ];
        
        $order = new Order($data);
        $order->save();

        $numberOrders = 10;

        for ($i = 1; $i < $numberOrders; $i++) {
            $data =  [
                'client_table_id' => 1,
                'status' => 'open',
            ];
            
            $order = new Order($data);
            $order->save();
        }

        echo "Orders populated with $numberOrders registers\n";
    }
}
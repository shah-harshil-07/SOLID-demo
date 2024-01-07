<?php

namespace App\Repositories;

class TotalSpendRepository extends CustomerRepository {
    function getData($data): int {
        $orders = $data ->orders;
        $order_sum = 0;

        foreach($orders as $order_data) {
            $items = $order_data->order_items;
            $item_sum = 0;

            foreach($items as $item_data) {
                $qty = $item_data->quantity;
                $price = $item_data->unit_price;
                $item_sum += ($qty * $price);
            }

            $order_sum += $item_sum;
        }

        return $order_sum;
    }
}
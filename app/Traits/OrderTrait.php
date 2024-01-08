<?php

namespace App\Traits;

trait OrderTrait {
    private function getTotalOrders($orders) {
        return count($orders);
    }

    private function getTotalSpend($orders) {
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

    private function getTotalItems($orders) {
        return array_sum(
            array_column(
                array_map(
                    function($order_obj) {
                        return ["count" => count($order_obj->order_items)];
                    },
                    $orders
                ),
                "count"
            )
        );
    }
}

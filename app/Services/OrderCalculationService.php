<?php

namespace App\Services;

class OrderCalculationService {
    private $orders;
    private $order_sum;
    private $total_items;
    private $total_orders;

    function __construct($orders) {
        $this->orders = $orders;
    }

    function getTotalOrders(): int {
        return count($this->orders);
    }

    function getTotalSpend(): int {
        $order_sum = 0;

        foreach($this->orders as $order_data) {
            $items = $order_data["order_items"];
            $order_sum += $this->getItemSum($items);
        }

        return $order_sum;
    }

    function getItemSum($items): int {
        $item_sum = 0;

        foreach($items as $item_data) {
            $qty = $item_data["quantity"];
            $price = $item_data["unit_price"];
            $item_sum += ($qty * $price);
        }

        return $item_sum;
    }

    function getTotalItems(): int {
        return array_sum(
            array_column(
                array_map(
                    function($order_obj) {
                        return ["count" => count($order_obj["order_items"])];
                    },
                    $this->orders
                ),
                "count"
            )
        );
    }
}
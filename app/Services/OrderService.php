<?php

namespace App\Services;

use App\Services\OrderCalculationService;

class OrderService {
    private $total_spend;
    private $order_count;
    private $total_items;

    function __construct($order_data) {
        $order_calculator = new OrderCalculationService($order_data);
        $this->total_spend = $order_calculator->getTotalSpend();
        $this->total_items = $order_calculator->getTotalItems();
        $this->order_count = $order_calculator->getTotalOrders();
    }

    function getTotalSpend(): int {
        return $this->total_spend;
    }

    function getAvgOrder(): int {
        return ($this->total_spend / $this->order_count);
    }

    function getAvgItems(): int {
        return ($this->total_items / $this->order_count);
    }
}
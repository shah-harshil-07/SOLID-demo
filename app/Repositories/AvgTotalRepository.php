<?php

namespace App\Repositories;

use App\Traits\OrderTrait;

class AvgTotalRepository extends CustomerRepository {
    use OrderTrait;

    function getData($data): int {
        $orders = $data->orders;
        $total_spend = $this->getTotalSpend($orders);
        $order_count = $this->getTotalOrders($orders);

        return ($total_spend / $order_count);
    }
}
<?php

namespace App\Repositories;

use App\Traits\OrderTrait;

class AvgItemsRepository extends CustomerRepository {
    use OrderTrait;

    function getData($data): int {
        $total_items = $this->getTotalItems($data->orders);
        $total_orders = $this->getTotalOrders($data->orders);

        return ($total_items / $total_orders);
    }
}
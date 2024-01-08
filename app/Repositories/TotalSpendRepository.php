<?php

namespace App\Repositories;

use App\Traits\OrderTrait;

class TotalSpendRepository extends CustomerRepository {
    use OrderTrait;

    function getData($data): int {
        $orders = $data ->orders;
        return $this->getTotalSpend($orders);
    }
}
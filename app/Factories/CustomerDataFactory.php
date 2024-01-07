<?php

namespace App\Factories;

use App\Repositories\IdRepository;
use App\Repositories\NameRepository;
use App\Repositories\EmailRepository;
use App\Repositories\AvgItemsRepository;
use App\Repositories\AvgTotalRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\TotalSpendRepository;

class CustomerDataFactory {
    public function getDataRepository($key): CustomerRepository {
        switch ($key) {
            case "customer_id":
                return new IdRepository();
            case "name":
                return new NameRepository();
            case "email":
                return new EmailRepository();
            case "total_spend":
                return new TotalSpendRepository();
            case "average_order_total":
                return new AvgTotalRepository();
            case "average_order_items":
                return new AvgItemsRepository();
            default:
                return new AvgItemsRepository();
        }
    }
}
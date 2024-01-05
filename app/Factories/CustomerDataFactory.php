<?php

namespace Factories\CustomerDataFactory;

use App\Repositories\CustomerRepository;
use App\Repositories\IdRepository;

class CustomerDataFactory {
    public function getDataRepository($key): CustomerRepository {
        switch ($key) {
            case "customer_id":
                return new IdRepository();
            default:
                break;
        }
    }
}
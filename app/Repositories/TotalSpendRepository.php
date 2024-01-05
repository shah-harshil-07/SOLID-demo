<?php

namespace App\Respository;

use CustomerRepository;

class TotalSpendRepository extends CustomerRepository {
    public function getData($data) {
        return 50;
    }
}
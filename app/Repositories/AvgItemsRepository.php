<?php

namespace App\Respository;

use CustomerRepository;

class AvgItemsRepository extends CustomerRepository {
    public function getData($data) {
        return 5;
    }
}
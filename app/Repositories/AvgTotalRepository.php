<?php

namespace App\Respository;

use CustomerRepository;

class AvgTotalRepository extends CustomerRepository {
    public function getData($data) {
        return 50;
    }
}
<?php

namespace App\Respository;

use CustomerRepository;

class IdRepository extends CustomerRepository {
    public function getData($data) {
        return 123;
    }
}
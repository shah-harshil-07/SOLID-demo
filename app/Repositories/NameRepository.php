<?php

namespace App\Respository;

use CustomerRepository;

class NameRepository extends CustomerRepository {
    public function getData($data) {
        return "Name";
    }
}
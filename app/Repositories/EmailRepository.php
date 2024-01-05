<?php

namespace App\Respository;

use CustomerRepository;

class EmailRepository extends CustomerRepository {
    public function getData($data) {
        return "Email";
    }
}
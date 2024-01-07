<?php

namespace App\Repositories;

class IdRepository extends CustomerRepository {
    function getData($data): int {
        return $data->customer_id;
    }
}
<?php

namespace App\Repositories;

class IdRepository implements CustomerRepository {
    function getData($data): int {
        return $data->customer_id;
    }
}
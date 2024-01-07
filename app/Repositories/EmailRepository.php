<?php

namespace App\Repositories;

class EmailRepository extends CustomerRepository {
    function getData($data): string {
        return $data->email;
    }
}
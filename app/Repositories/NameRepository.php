<?php

namespace App\Repositories;

class NameRepository extends CustomerRepository {
    function getData($data): string {
        return $data->name;
    }
}
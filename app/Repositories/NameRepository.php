<?php

namespace App\Repositories;

class NameRepository implements CustomerRepository {
    function getData($data): string {
        return $data->name;
    }
}
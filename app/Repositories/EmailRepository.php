<?php

namespace App\Repositories;

class EmailRepository implements CustomerRepository {
    function getData($data): string {
        return $data->email;
    }
}
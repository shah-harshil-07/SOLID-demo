<?php

namespace App\Repositories;

interface CustomerRepository {
    function getData($data): string | int;
}
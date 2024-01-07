<?php

namespace App\Repositories;

abstract class CustomerRepository {
    abstract protected function getData($data): string | int;
}
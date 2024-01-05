<?php

namespace App\Respository;

abstract class CustomerRepository {
    abstract protected function getData($data): number | string;
}
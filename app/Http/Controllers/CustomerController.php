<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;

class CustomerController extends Controller {
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService) {
        $this->customerService = $customerService;
    }

    public function show() {
        return $this->customerService->getCustomers();
    }
}
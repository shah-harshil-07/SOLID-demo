<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\Storage;

class CustomerService {
    protected $customerData;

    public function __construct() {
        try {
            $customersJson = Storage::disk("customers")->get("customer_order.jsonl");
            $this->customerData = json_decode($customersJson);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return null;
        }
    }

    function getCustomers() {
        try {
            $customersJson = Storage::disk("customers")->get("customer_order.jsonl");
            $this->customerData = json_decode($customersJson);
            return $this->customerData;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return null;
        }
    }
}
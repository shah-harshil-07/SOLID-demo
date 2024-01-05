<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\Storage;

class CustomerService {
    protected $customerData;

    function getCustomers() {
        try {
            $customersJson = Storage::disk("customers")->get("customer_order.jsonl");
            return json_decode($customersJson);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return null;
        }
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CustomerService {
    protected $customerData;
    private OrderService $order_service;

    function getCustomers(): array {
        $customersJson = Storage::disk("customers")->get("customer_order.jsonl");
        $this->customerData = json_decode($customersJson, true);
        return $this->arrangeCustomerData();
    }

    function arrangeCustomerData(): array {
        $formattedCustomers = [];

        foreach ($this->customerData as $customerObj) {
            $customer_data = $customerObj["customer"];
            $order_data = $customer_data["orders"];
            $this->order_service = new OrderService($order_data);

            array_push(
                $formattedCustomers,
                [
                    "customer_id"         => $customer_data["customer_id"],
                    "name"                => $customer_data["name"],
                    "email"               => $customer_data["email"],
                    "total_spend"         => $this->order_service->getTotalSpend(),
                    "average_order_total" => $this->order_service->getAvgOrder(),
                    "average_order_items" => $this->order_service->getAvgItems(),
                ]
            );
        }

        return $formattedCustomers;
    }
}
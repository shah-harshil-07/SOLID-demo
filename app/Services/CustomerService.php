<?php

namespace App\Services;

use App\Repositories\IdRepository;
use App\Factories\CustomerDataFactory;
use App\Repositories\EmailRepository;
use App\Repositories\NameRepository;
use App\Repositories\TotalSpendRepository;
use Illuminate\Support\Facades\Storage;

class CustomerService {
    protected $customerData;
    private IdRepository $idRepository;
    private NameRepository $nameRepository;
    private EmailRepository $emailRepository;
    private CustomerDataFactory $customerFactory;
    private TotalSpendRepository $totalSpendRepository;

    public function __construct(CustomerDataFactory $customerDataFactory) {
        try {
            $customersJson = Storage::disk("customers")->get("customer_order.jsonl");
            $this->customerData = json_decode($customersJson);

            $this->customerFactory = $customerDataFactory;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return null;
        }
    }

    function getCustomers() {
        try {
            $customersJson = Storage::disk("customers")->get("customer_order.jsonl");
            $this->customerData = json_decode($customersJson);
            return $this->arrangeCustomerData();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return null;
        }
    }

    function arrangeCustomerData() {
        $formattedCustomers = [];
        $n = count($this->customerData);

        for ($i = 0; $i < $n; $i++) {
            $customerObj = $this->customerData[$i];
            // return $customerObj->customer;

            array_push(
                $formattedCustomers,
                [
                    "customer_id" => $this->getId($customerObj),
                    "name"        => $this->getName($customerObj),
                    "email"       => $this->getEmail($customerObj),
                    "total_spend" => $this->getTotalSpend($customerObj),
                ]
            );
        }

        return $formattedCustomers;
    }

    function getId($customerObj) {
        $this->idRepository = $this->customerFactory->getDataRepository("customer_id");
        return $this->idRepository->getData($customerObj->customer);
    }

    function getName($customerObj) {
        $this->nameRepository = $this->customerFactory->getDataRepository(("name"));
        return $this->nameRepository->getData(($customerObj->customer));
    }

    function getEmail($customerObj) {
        $this->emailRepository = $this->customerFactory->getDataRepository(("email"));
        return $this->emailRepository->getData(($customerObj->customer));
    }

    function getTotalSpend($customerObj) {
        $this->totalSpendRepository = $this->customerFactory->getDataRepository(("total_spend"));
        return $this->totalSpendRepository->getData(($customerObj->customer));
    }
}
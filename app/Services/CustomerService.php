<?php

namespace App\Services;

use App\Repositories\IdRepository;
use App\Repositories\NameRepository;
use App\Repositories\EmailRepository;
use App\Factories\CustomerDataFactory;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AvgItemsRepository;
use App\Repositories\AvgTotalRepository;
use App\Repositories\TotalSpendRepository;

class CustomerService {
    protected $customerData;
    private IdRepository $idRepository;
    private NameRepository $nameRepository;
    private EmailRepository $emailRepository;
    private CustomerDataFactory $customerFactory;
    private AvgTotalRepository $avgTotalRepository;
    private AvgItemsRepository $avgItemsRepository;
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

            array_push(
                $formattedCustomers,
                [
                    "customer_id"         => $this->getId($customerObj),
                    "name"                => $this->getName($customerObj),
                    "email"               => $this->getEmail($customerObj),
                    "total_spend"         => $this->getTotalSpend($customerObj),
                    "average_order_total" => $this->getAvgOrder($customerObj),
                    "average_order_items" => $this->getAvgItems($customerObj),
                ]
            );
        }

        return $formattedCustomers;
    }

    function getId($customerObj) {
        $this->idRepository = $this->customerFactory->getDataRepository("customer_id");
        return isset($this->idRepository) ? $this->idRepository->getData($customerObj->customer) : null;
    }

    function getName($customerObj) {
        $this->nameRepository = $this->customerFactory->getDataRepository(("name"));
        return isset($this->idRepository) ? $this->nameRepository->getData(($customerObj->customer)) : null;
    }

    function getEmail($customerObj) {
        $this->emailRepository = $this->customerFactory->getDataRepository(("email"));
        return isset($this->emailRepository) ? $this->emailRepository->getData(($customerObj->customer)) : null;
    }

    function getTotalSpend($customerObj) {
        $this->totalSpendRepository = $this->customerFactory->getDataRepository(("total_spend"));
        return isset($this->totalSpendRepository) ? $this->totalSpendRepository->getData(($customerObj->customer)) : null;
    }

    function getAvgOrder($customerObj) {
        $this->avgTotalRepository = $this->customerFactory->getDataRepository(("average_order_total"));
        return isset($this->avgTotalRepository) ? $this->avgTotalRepository->getData(($customerObj->customer)) : null;
    }

    function getAvgItems($customerObj) {
        $this->avgItemsRepository = $this->customerFactory->getDataRepository(("average_order_items"));
        return isset($this->avgItemsRepository) ? $this->avgItemsRepository->getData(($customerObj->customer)) : null;
    }
}
<?php

namespace Quicktane\Core\Services;

use Quicktane\Core\Dto\CustomerDto;
use Quicktane\Core\Models\Customer;

class CustomerService
{
    public function create(CustomerDto $dto): Customer
    {
        $customer = Customer::query()->newModelInstance($dto->toArray());
        $customer->title = $this->preGeneratedTitle($customer);
        $customer->save();

        return $customer;
    }

    public function update(Customer $customer, CustomerDto $dto): Customer
    {
        $customer->fill($dto->toArray());
        $customer->save();

        return $customer;
    }

    public function delete(Customer $customer): bool
    {
        return $customer->delete();
    }

    public function preGeneratedTitle(Customer $customer): string
    {
        return $customer->company_name ? $customer->company_name : $customer->first_name.' '.$customer->last_name;
    }
}
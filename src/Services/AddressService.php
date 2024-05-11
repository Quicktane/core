<?php

namespace Quicktane\Core\Services;

use Quicktane\Core\Dto\AddressDto;
use Quicktane\Core\Models\Address;
use Quicktane\Core\Models\Customer;

class AddressService
{
    public function create(AddressDto $dto): Address
    {
        $address = Address::query()->newModelInstance($dto->toArray());
        $address->title = $this->preGeneratedTitle($address);
        $address->save();

        return $address;
    }

    public function update(Address $address, AddressDto $dto): Address
    {
        $address->fill($dto->toArray());
        $address->save();

        return $address;
    }

    public function delete(Customer $customer): bool
    {
        return $customer->delete();
    }

    public function preGeneratedTitle(Address $address): string
    {
        return $address->company_name ? $address->company_name : $address->first_name.' '.$address->last_name;
    }
}
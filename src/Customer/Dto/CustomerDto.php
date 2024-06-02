<?php

namespace Quicktane\Core\Customer\Dto;

use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Dto;

class CustomerDto extends Dto
{
    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $first_name;

    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $last_name;

    #[Rules(['nullable', 'string', 'min:3', 'max:255'])]
    public ?string $company_name;

    #[Rules(['nullable', 'email', 'unique:qt_customers,email'])]
    public ?string $email;

    #[Rules(['nullable', 'string'])]
    public ?string $phone;

    #[Rules(['nullable', 'string', 'max:255'])]
    public ?string $vat_no;

    #[Rules(['nullable', 'string', 'max:255'])]
    public ?string $account_ref;

    #[Rules(['nullable', 'array'])]
    public ?array $meta;
}

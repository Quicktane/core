<?php

namespace Quicktane\Core\Customer\Dto;

use Illuminate\Validation\Rules\Enum;
use Quicktane\Core\Base\Dto\Attributes\Cast;
use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Casting\BooleanCast;
use Quicktane\Core\Base\Dto\Casting\IntegerCast;
use Quicktane\Core\Base\Dto\Dto;
use Quicktane\Core\Customer\Enums\AddressType;

class AddressDto extends Dto
{
    #[Rules(['required', 'integer'])]
    #[Cast(IntegerCast::class)]
    public int $customer_id;

    #[Rules(['required', 'integer'])]
    #[Cast(IntegerCast::class)]
    public int $country_id;

    #[Rules(['required', 'string', new Enum(AddressType::class)])]
    public string $type;

    #[Rules(['nullable', 'string', 'min:3', 'max:255'])]
    public ?string $title;

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

    #[Rules(['required', 'string', 'max:255'])]
    public string $line_one;

    #[Rules(['nullable', 'string', 'max:255'])]
    public ?string $line_two;

    #[Rules(['nullable', 'string', 'max:255'])]
    public ?string $line_three;

    #[Rules(['required', 'string', 'max:255'])]
    public string $city;

    #[Rules(['nullable', 'string', 'max:255'])]
    public ?string $state;

    #[Rules(['nullable', 'string', 'max:255'])]
    public ?string $postcode;

    #[Rules(['nullable', 'string'])]
    public ?string $delivery_instructions;

    #[Rules(['nullable', 'array'])]
    public ?array $meta;

    #[Rules(['nullable', 'bool'])]
    #[Cast(BooleanCast::class)]
    public ?bool $default;

    public function defaults(): array
    {
        return [
            'default' => false,
        ];
    }

    public function asDefault(): static
    {
        return new static(array_merge($this->toArray(), ['default' => true]));
    }
}

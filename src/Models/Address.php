<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\AddressFactory;

/**
 * @property int $id
 * @property int $customer_id
 * @property ?string $title
 * @property string $first_name
 * @property string $last_name
 * @property ?string $company_name
 * @property string $line_one
 * @property ?string $line_two
 * @property ?string $line_three
 * @property string $city
 * @property ?string $state
 * @property ?string $postcode
 * @property int $country_id
 * @property ?string $delivery_instructions
 * @property ?string $contact_mail
 * @property ?string $contact_phone
 * @property ?Carbon $last_used_at
 * @property array $meta
 * @property bool $shipping_default
 * @property bool $billing_default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property Customer $customer
 * @property Country $country
 */
class Address extends BaseModel
{
    use HasFactory;

    protected $casts = [
        'billing_default' => 'boolean',
        'shipping_default' => 'boolean',
        'meta' => AsArrayObject::class,
    ];

    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}

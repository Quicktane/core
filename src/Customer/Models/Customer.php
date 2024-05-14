<?php

namespace Quicktane\Core\Customer\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\CustomerFactory;
use Quicktane\Core\Product\Models\Attribute;

/**
 * @property int     $id
 * @property ?string $title
 * @property string  $first_name
 * @property string  $last_name
 * @property ?string $company_name
 * @property ?string $vat_no
 * @property ?string $account_ref
 * @property ?array  $meta
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Customer extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    /**
     * {@inheritDoc}
     */
    protected $casts = [
        'meta' => AsCollection::class,
    ];

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }

    /**
     * Return the customer group relationship.
     */
    public function customerGroups(): BelongsToMany
    {
        return $this->belongsToMany(CustomerGroup::class, "qt_customer_customer_group")->withTimestamps();
    }

    /**
     * Return the addresses relationship.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Return the orders relationship.
     */
//    public function orders(): HasMany
//    {
//        return $this->hasMany(Order::class);
//    }

    /**
     * Get the mapped attributes relation.
     */
    public function mappedAttributes(): MorphToMany
    {
        $prefix = config('lunar.database.table_prefix');

        return $this->morphToMany(
            Attribute::class,
            'attributable',
            "{$prefix}attributables"
        )->withTimestamps();
    }
}

<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\CustomerGroupFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class CustomerGroup extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): CustomerGroupFactory
    {
        return CustomerGroupFactory::new();
    }

    public function customers(): BelongsToMany
    {
        $prefix = config('lunar.database.table_prefix');

        return $this->belongsToMany(
            Customer::class,
            "{$prefix}customer_customer_group"
        )->withTimestamps();
    }
}

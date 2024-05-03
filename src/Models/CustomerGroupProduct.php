<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\CustomerGroupProductFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class CustomerGroupProduct extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): CustomerGroupProductFactory
    {
        return CustomerGroupProductFactory::new();
    }

    public function customerGroups(): BelongsTo
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

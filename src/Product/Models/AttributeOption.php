<?php

namespace Quicktane\Core\Product\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Quicktane\Core\Base\Model;

/**
 * @property int    $id
 * @property string $name
 * @property string $slug
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class AttributeOption extends Model
{
    protected $guarded = [];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}

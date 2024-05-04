<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\Model;

/**
 * @property int     $id
 * @property string  $attribute_type
 * @property int     $attribute_group_id
 * @property int     $position
 * @property string  $name
 * @property string  $handle
 * @property string  $section
 * @property string  $type
 * @property bool    $required
 * @property ?string $default_value
 * @property string  $configuration
 * @property bool    $system
 * @property string  $validation_rules
 * @property bool    $filterable
 * @property bool    $searchable
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

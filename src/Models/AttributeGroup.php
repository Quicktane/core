<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\Model;

/**
 * @property int     $id
 * @property string  $attributable_type
 * @property string  $name
 * @property string  $handle
 * @property int     $position
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class AttributeGroup extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => AsCollection::class,
    ];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_group_attributes');
    }
}

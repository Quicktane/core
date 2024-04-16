<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
class Attribute extends Model
{
    use HasFactory;

    /**
     * Define which attributes should be cast.
     *
     * @var array
     */
    protected $casts = [
//        'name'          => AsCollection::class,
//        'configuration' => AsCollection::class,
    ];

    /**
     * Returns the attribute group relation.
     */
    public function attributeGroup(): BelongsToMany
    {
        return $this->belongsToMany(AttributeGroup::class, 'attribute_group_attributes');
    }
}

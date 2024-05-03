<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property string $tag_id
 * @property string $taggable_type
 * @property int $taggable_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class Taggables extends BaseModel
{
    use HasFactory;

    protected $guarded = [];
}

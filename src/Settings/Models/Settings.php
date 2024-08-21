<?php

namespace Quicktane\Core\Settings\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property string $key
 * @property string $value
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Settings extends BaseModel
{
    protected $guarded = [];
}

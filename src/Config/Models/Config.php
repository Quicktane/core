<?php

namespace Quicktane\Core\Config\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property string $key
 * @property string $value
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Config extends BaseModel
{
    protected $guarded = [];
}

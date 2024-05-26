<?php

namespace Quicktane\Core\Config\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;

    protected $guarded = [];
}

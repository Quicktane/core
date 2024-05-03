<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\ChannelFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Carbon $deleted_at
 */
class Channel extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected static function newFactory(): ChannelFactory
    {
        return ChannelFactory::new();
    }
}

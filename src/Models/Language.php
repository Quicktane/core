<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\ChannelFactory;
use Quicktane\Core\Database\Factories\LanguageFactory;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property bool $default
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Language extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): LanguageFactory
    {
        return LanguageFactory::new();
    }

    public function urls(): HasMany
    {
        return $this->hasMany(Url::class);
    }
}

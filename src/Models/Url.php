<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\UrlFactory;

/**
 * @property int $id
 * @property int $language_id
 * @property string $element_type
 * @property int $element_id
 * @property string $slug
 * @property bool $default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property Language $language
 */
class Url extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'default' => 'boolean',
    ];

    protected static function newFactory(): UrlFactory
    {
        return UrlFactory::new();
    }

    //TODO
//    public function element(): MorphTo
//    {
//        return $this->morphTo();
//    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}

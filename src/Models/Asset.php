<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class Asset extends BaseModel
{
    /**
     * Define which attributes should be
     * protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the associated file.
     */
    public function file(): MorphOne
    {
        return $this->morphOne(config('media-library.media_model'), 'model');
    }
}
